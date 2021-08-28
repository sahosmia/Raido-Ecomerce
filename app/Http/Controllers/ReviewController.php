<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use Auth;
use Carbon\Carbon;

class ReviewController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('checkauth');
    }

    // product page view
    public function review_add(Request $req)
    {
        $comment = $req->comment;
        $rating = $req->rating;
        $product = $req->product;
        $created_at = Carbon::now();
        $added_by = Auth::id();


        $req->validate([
            'comment' => 'required',
            'rating' => 'required',
        ]);


        Review::insert([
            "comment" => $comment,
            "rating" => $rating,
            "product" => $product,
            "user" => $added_by,
            "created_at" => $created_at,
        ]);

        return back()->with('success', 'You are success to add a new cupon');
    }
}
