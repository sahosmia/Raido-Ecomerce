<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use App\Models\District;
use App\Models\Division;
use Carbon\Carbon;
use Cookie;

class CheckoutController extends Controller
{
    public function checkout()
    {
        if (Cart::where('cookie', Cookie::get('cart'))->exists()) {

            return view('frontend.checkout', [
                // 'coupon' => $coupon,
                // 'discount' => $discount,
                'divisions' => Division::all(),
                'districts' => District::all(),
                'cart_items' => Cart::where('cookie', Cookie::get('cart'))->get(),
            ]);
        } else {
            return view('include.frontend.login_message_page', [
                'message' => 'checkout_message',
            ]);
        }
    }

    public function getdistrictname(Request $req)
    {

        $districts = District::where('division_id', $req->id)->get();
        $data = "<option value=''>Select</option>";
        foreach ($districts as $item) {
            $data .= "<option value='$item->id'>$item->name</option>";
        }
        return $data;
    }
}
