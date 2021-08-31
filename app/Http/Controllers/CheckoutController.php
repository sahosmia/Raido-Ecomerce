<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('frontend.checkout', [
            // 'coupon' => $coupon,
            // 'discount' => $discount,
            // 'cart_items' => Cart::where('cookie', Cookie::get('cart'))->get(),
        ]);
    }
}
