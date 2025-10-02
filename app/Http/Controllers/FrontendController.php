<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Review;
use App\Models\Subcategory;

class FrontendController extends Controller
{
    # front
    public function index()
    {
        return view('frontend.index', [
            'brands' => Brand::where('action', 1)->latest()->get(),
            'categories' => Category::where('action', 1)->latest()->get(),
            'best_seller' => Product::with('category_info', 'subcategory_info')->where('action', 1)->latest()->get(),
            'products' => Product::with('category_info', 'subcategory_info')->where('action', 1)->orderBy('best_sell', 'desc')->latest()->get(),
        ]);
    }

    # about
    public function about()
    {
        return view('frontend.about', [
            'brands' => Brand::where('action', 1)->latest()->get(),
            'categories' => Category::where('action', 1)->latest()->get(),
            'products' => Product::with('category_info', 'subcategory_info')->where('action', 1)->latest()->get(),
        ]);
    }

    # search
    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::with('category_info', 'subcategory_info')
            ->where('name', 'like', '%' . $search . '%')
            ->where('action', 1)
            ->latest()
            ->get();

        return view('frontend.search', compact('products'));
    }

    // contact_us
    public function contact_us()
    {
        return view('frontend.contact_us');
    }

    public function allproduct($category_slug, $subcategory_slug = null)
    {
        $categories = Category::where('action', 1)->latest()->get();
        $subcategories = Subcategory::where('action', 1)->latest()->get();
        $productsQuery = Product::with('category_info', 'subcategory_info')->where('action', 1);

        if ($category_slug !== 'all') {
            $category = Category::where('slug', $category_slug)->firstOrFail();
            $productsQuery->where('category', $category->id);

            if ($subcategory_slug) {
                $subcategory = Subcategory::where('slug', $subcategory_slug)->where('category', $category->id)->firstOrFail();
                $productsQuery->where('subcategory', $subcategory->id);
            }
        }

        $products = $productsQuery->latest()->get();

        return view('frontend.shop', compact('categories', 'subcategories', 'products'));
    }

    public function product_view_single(Product $product)
    {
        $product->load('photos', 'reviews.user');

        $other_products = Product::with('category_info', 'subcategory_info')
            ->where('subcategory', $product->subcategory)
            ->where('id', '!=', $product->id)
            ->where('action', 1)
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.product', compact('product', 'other_products'));
    }
}
