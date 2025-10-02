<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Cupon;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cookie;

class CartController extends Controller
{
    public function cart($coupon_code = "")
    {
        $cookie_name = Cookie::get('cart');
        if (!$cookie_name) {
            return view('frontend.cart', ['cart_items' => collect()]);
        }

        $cart_items = Cart::with('product')->where('cookie', $cookie_name)->get();

        if ($cart_items->isEmpty()) {
            return view('frontend.cart', ['cart_items' => collect()]);
        }

        $discount = 0;
        if ($coupon_code) {
            $coupon = Cupon::where('code', $coupon_code)->first();
            if ($coupon) {
                $discount = $coupon->discount;
            } else {
                return back()->with('error', 'Invalid coupon code.');
            }
        }

        return view('frontend.cart', compact('cart_items', 'discount', 'coupon_code'));
    }

    public function cartadd($id)
    {
        if (!Auth::check()) {
            return view('include.frontend.login_message_page', ['message' => 'Please login to add items to your cart.']);
        }

        $product = Product::findOrFail($id);
        if ($product->quantity == 0) {
            return back()->with('error', 'This item is out of stock.');
        }

        $cookie_name = Cookie::get('cart') ?? Str::random(5) . time();
        Cookie::queue(Cookie::make('cart', $cookie_name, 7200));

        $cart = Cart::firstOrNew(['cookie' => $cookie_name, 'product' => $id]);
        $cart->quantity += 1;
        $cart->save();

        return back()->with('success_with_btn', 'Product added to cart successfully.');
    }

    public function cartaddmultiple(Request $request)
    {
        if (!Auth::check()) {
            return response()->json(['message' => 'Unauthenticated.'], 401);
        }

        $product = Product::findOrFail($request->id);
        if ($product->quantity < $request->quantity) {
            return back()->with('error', 'Not enough items in stock.');
        }

        $cookie_name = Cookie::get('cart') ?? Str::random(5) . time();
        Cookie::queue(Cookie::make('cart', $cookie_name, 7200));

        $cart = Cart::firstOrNew(['cookie' => $cookie_name, 'product' => $request->id]);
        $cart->quantity += $request->quantity;
        $cart->save();

        return back()->with('success_with_btn', 'Products added to cart successfully.');
    }

    public function cartdelete($id)
    {
        $cart_item = Cart::where('id', $id)->where('cookie', Cookie::get('cart'))->firstOrFail();
        $cart_item->forceDelete();
        return back()->with('success', 'Item removed from cart.');
    }

    public function update_cart(Request $request)
    {
        $cookie_name = Cookie::get('cart');
        if (!$cookie_name) {
            return back()->with('error', 'Your cart has expired.');
        }

        foreach ($request->quantity as $cart_id => $quantity) {
            $cart_item = Cart::where('id', $cart_id)->where('cookie', $cookie_name)->first();
            if ($cart_item) {
                $cart_item->update(['quantity' => $quantity]);
            }
        }

        return back()->with('success', 'Cart updated successfully.');
    }
}
