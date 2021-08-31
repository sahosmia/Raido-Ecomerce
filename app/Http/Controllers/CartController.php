<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Cart;
use App\Models\Cupon;
use App\Models\Product;
use Carbon\Carbon;
use Cookie;
use Illuminate\Support\Str;

class CartController extends Controller
{
    public function cart($coupon = "")
    {
        if ($coupon == "") {
            $discount = 0;
        } else {
            if (Cupon::where('code', $coupon)->exists()) {
                $discount = Cupon::where('code', $coupon)->first()->discount;
            } else {
                $discount = 0;
                back()->with('error', 'this is not valid coupon');
            }
        }



        // die();

        return view('frontend.cart', [
            'coupon' => $coupon,
            'discount' => $discount,
            'cart_items' => Cart::where('cookie', Cookie::get('cart'))->get(),
        ]);
    }
    // single item add cart
    public function cartadd($id)
    {
        if (Auth::check()) {
            if (Product::find($id)->quantity == 0) {
                return back()->with('error', 'this item is out of stok');
            } else {
                if (Cookie::get('cart')) {
                    $cookie_name = Cookie::get('cart');
                } else {
                    $cookie_name = Str::random(5) . time();
                    Cookie::queue(Cookie::make('cart', $cookie_name, 7200));
                }
                if (Cart::where('cookie', $cookie_name)->where('product', $id)->exists()) {
                    Cart::where('cookie', $cookie_name)->where('product', $id)->increment('quantity', 1);
                } else {
                    Cart::insert([
                        "cookie" => $cookie_name,
                        "product" => $id,
                        "quantity" => 1,
                        "created_at" => Carbon::now(),
                    ]);
                }
                return back()->with('success_with_btn', 'you are success');
            }
        } else {
            echo "return message page";
        }
    }
    // multiple cart item add
    public function cartaddmultiple(Request $req)
    {
        if (Auth::check()) {
            $id = $req->id;
            $quantity = $req->quantity;
            if (Product::find($id)->quantity == 0) {
                return back()->with('error', 'this item is out of stok');
            } else {


                if (Cookie::get('cart')) {
                    $cookie_name = Cookie::get('cart');
                } else {
                    $cookie_name = Str::random(5) . time();
                    Cookie::queue(Cookie::make('cart', $cookie_name, 7200));
                }

                if (Cart::where('cookie', $cookie_name)->where('product', $id)->exists()) {
                    Cart::where('cookie', $cookie_name)->where('product', $id)->increment('quantity', $quantity);
                } else {
                    Cart::insert([
                        "cookie" => $cookie_name,
                        "product" => $id,
                        "quantity" => $quantity,
                        "created_at" => Carbon::now(),
                    ]);
                }
                return back()->with('success_with_btn', 'you are success');
            }
        } else {
            echo "return message page";
        }
    }

    // cart item delete
    public function cartdelete($id)
    {
        Cart::where('product', $id)->forceDelete();
        return back()->with('success', 'You are success');
    }
    // cart item delete
    public function update_cart(Request $req)
    {
        print_r($req->all());
        foreach ($req->quantity as $id => $item_quantity) {
            echo $id;
            echo $item_quantity;
            Cart::find($id)->update([
                'quantity' => $item_quantity,
            ]);
        }

        return back()->with('success', 'You are success');
    }
}
