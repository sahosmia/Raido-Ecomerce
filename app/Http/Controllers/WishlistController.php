<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Wishlist;
use Carbon\Carbon;
use Cookie;
use Illuminate\Support\Str;

class WishlistController extends Controller
{

    public function wishlist()
    {

        // wishlist add view
        return view('frontend.wishlist', [
            'wishlists' => Wishlist::where('cookie_name', Cookie::get('wishlist'))->get(),
        ]);
    }


    // wishlist add
    public function wishlistadd($id)
    {
        if (Cookie::get('wishlist')) {

            $cookie_name = Cookie::get('wishlist');
        } else {

            $cookie_name = Str::random(5) . time();
            Cookie::queue(Cookie::make('wishlist', $cookie_name, 7200));
        }
        if (!Wishlist::where('cookie_name', $cookie_name)->where('product_id', $id)->exists()) {
            Wishlist::insert([
                "cookie_name" => $cookie_name,
                "product_id" => $id,
                "created_at" => Carbon::now(),
            ]);
        }
        return back();
    }


    // wishlist delete
    public function wishlistdelete($id)
    {
        Wishlist::find($id)->forceDelete();
        return back()->with('success', 'You are success');
    }
}
