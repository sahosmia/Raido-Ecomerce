<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Product;
use App\Models\Cart;
use App\Models\Cupon;
use App\Models\District;
use App\Models\Division;
use App\Models\Order;
use App\Models\Order_billing_detail;
use App\Models\Order_detail;
use Carbon\Carbon;
use Cookie;
use Auth;

class OrderController extends Controller
{
    public function order_submit(Request $request)
    {
        $cupon = Cupon::where('code', $request->cupon)->first();
        $cookie = Cookie::get('cart');

        if ($request->payment_method == 1) { // Cash on delivery
            DB::transaction(function () use ($request, $cookie, $cupon) {
                Order_billing_detail::create([
                    'name' => $request->name,
                    'email' => $request->email,
                    'division' => $request->division,
                    'district' => $request->district,
                    'address' => $request->address,
                    'zip_code' => $request->zip,
                    'phone' => $request->phone,
                    'cookie' => $cookie,
                ]);

                Order_detail::create([
                    'payment_method' => $request->payment_method,
                    'user_id' => Auth::id(),
                    'total' => $request->total,
                    'cupon_id' => $cupon->id ?? null,
                    'cookie' => $cookie,
                ]);

                $cart_items = Cart::where('cookie', $cookie)->get();
                $orders = [];
                foreach ($cart_items as $item) {
                    $orders[] = [
                        'product_id' => $item->product,
                        'quantity' => $item->quantity,
                        'cookie' => $item->cookie,
                        'created_at' => now(),
                        'updated_at' => now(),
                    ];
                }
                Order::insert($orders);

                Cart::where('cookie', $cookie)->forceDelete();
            });

            Cookie::queue(Cookie::forget('cart'));
            return response()->json(['status' => 'success', 'message' => 'Order placed successfully.']);
        } else { // Online payment
            $all_data = [
                "name" => $request->name,
                "email" => $request->email,
                "division" => $request->division,
                "district" => $request->district,
                "address" => $request->address,
                "zip" => $request->zip,
                "phone" => $request->phone,
                "payment_method" => $request->payment_method,
                "cookie" => $cookie,
                "cupon" => $cupon->id ?? null,
            ];

            session(['all_data' => $all_data]);
            return redirect('/pay');
        }
    }

    public function index()
    {
        return view('frontend.order');
    }

    #order_backend
    public function order_backend()
    {
        $order_details = Order_detail::with('user', 'cupon', 'orders.product')
            ->latest()
            ->paginate(10);

        return view('backend.order.order', [
            'order_details' => $order_details,
        ]);
    }
}
