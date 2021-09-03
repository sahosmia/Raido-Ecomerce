<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;


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
    public function order_submit(Request $req)
    {
        $cupon = $req->cupon;

        if (Cupon::where('code', $cupon)->exists()) {
            $cupon = Cupon::where('code', $cupon)->first()->id;
        } else {
            $cupon = 0;
        }

        $cookie = Cookie::get('cart');
        $name = $req->name;
        $email = $req->email;
        $total = $req->total;
        $division = $req->division;
        $district = $req->district;
        $address = $req->address;
        $zip = $req->zip;
        $phone = $req->phone;
        $payment_method = $req->payment_method;


        if ($payment_method == 1) {

            Order_billing_detail::insert([
                'name' => $name,
                'email' => $email,
                'division' => $division,
                'district' => $district,
                'address' => $address,
                'zip_code' => $zip,
                'phone' => $phone,
                'cookie' => $cookie,
            ]);

            Order_detail::insert([
                'payment_method' => $payment_method,
                'user_id' => Auth::id(),
                'total' => $total,
                'cupon_id' => $cupon,
                'cookie' => $cookie,
                'created_at' => Carbon::now(),
            ]);
            $cart_item = Cart::where('cookie', Cookie::get('cart'))->get();
            foreach ($cart_item as $item) {
                Order::insert([
                    'product_id' => $item->product,
                    'quantity' => $item->quantity,
                    'cookie' => $item->cookie,
                ]);
                Cart::find($item->id)->forceDelete();
            }
            Cookie::queue(Cookie::forget('cart'));
            echo "done";
        } else {


            $all_data = array(
                "name" => $name,
                "email" => $email,
                "division" => $division,
                "district" => $district,
                "address" => $address,
                "zip" => $zip,
                "phone" => $phone,
                "payment_method" => $payment_method,
                "cookie" => $cookie,
                "cupon" => $cupon,
            );

            session([
                'all_data' => $all_data
            ]);
            return redirect('/pay');
        }
    }
    public function index()
    {
        return view('frontend.order');
    }
}
