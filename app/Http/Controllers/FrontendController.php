<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Product_photo;
use App\Models\Review;
use App\Models\Subcategory;

class FrontendController extends Controller
{
    # front
    public function index()
    {
        // $products = Product::where('action', 1)->get();
        // foreach ($products as $product) {
        //     echo $product;
        //     echo "<br>";
        // }
        // die();
        return view('frontend.index', [
            'brands' => Brand::where('action', 1)->get(),
            'categories' => Category::where('action', 1)->get(),
            'best_seller' => Product::where('action', 1)->get(),
            'products' => Product::where('action', 1)->get(),

        ]);
    }

    # about
    public function about()
    {



        return view('frontend.about', [
            'brands' => Brand::where('action', 1)->get(),
            'categories' => Category::where('action', 1)->get(),
            'products' => Product::where('action', 1)->get(),

        ]);
    }


    // contact_us
    public function contact_us()
    {
        return view('frontend.contact_us', []);
    }


    public function allproduct($category, $subcategory)
    {
        if ($category == 'all') {
            return view('frontend.shop', [
                'show_status' => "all",
                'categories' => Category::all(),
                'subcategories' => Subcategory::all(),
                'products' => Product::all(),
            ]);
        }
        if ($subcategory == "null") {
            return view('frontend.shop', [
                'show_status' => "only_category",
                'categories' => Category::where('action', 1)->get(),
                'subcategories' => Subcategory::where('action', 1)->get(),
                'products' => Product::where('category', $category)->get(),
            ]);
        } else {
            return view('frontend.shop', [
                'show_status' => "with_subcategory",
                'category_id' => $category,
                'categories' => Category::where('action', 1)->get(),
                'subcategories' => Subcategory::where('action', 1)->get(),
                'products' => Product::where('category', $category)->where('subcategory', $subcategory)->get(),
            ]);
        }
    }

    public function product_view_single($id)
    {

        $subcategory = Product::find($id)->subcategory;
        // die();
        return view('frontend.product', [
            'product' => Product::find($id),
            'other_products' => Product::where('subcategory', $subcategory)->where('id', '!=', $id)->get(),
            'product_photos' => Product_photo::where('product', $id)->get(),
            'reviews' => Review::where('product', $id)->get(),
            'reviews_count' => Review::where('product', $id)->count(),

        ]);
    }
}
