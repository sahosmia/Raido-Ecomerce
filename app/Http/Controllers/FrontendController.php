<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Subcategory;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'brands' => Brand::where('action', 1)->get(),
            'categories' => Category::where('action', 1)->get(),
        ]);
    }
    public function allproduct()
    {

        return view('frontend.shop', [
            // 'brands' => Brand::where('action', 1)->get(),
            'categories' => Category::where('action', 1)->get(),
            'subcategories' => Subcategory::where('action', 1)->get(),
        ]);
    }
}
