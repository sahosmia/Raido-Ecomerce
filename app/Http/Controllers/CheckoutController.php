<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Cart;
use Carbon\Carbon;
use Cookie;

class CheckoutController extends Controller
{
    public function checkout()
    {
        return view('frontend.checkout', [
            // 'coupon' => $coupon,
            // 'discount' => $discount,
            'cart_items' => Cart::where('cookie', Cookie::get('cart'))->get(),
        ]);
    }
}
