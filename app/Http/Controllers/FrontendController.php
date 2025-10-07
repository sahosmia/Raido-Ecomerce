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
        $products = Product::active()->withCount('reviews')->withAvg('reviews', 'rating');

        return view('frontend.index', [
            'brands' => Brand::active()->latest()->get(),
            'categories' => Category::active()->latest()->get(),
            'best_seller' => (clone $products)->latest()->get(),
            'products' => (clone $products)->orderBy('best_sell', 'desc')->latest()->get(),
        ]);
    }

    # about
    public function about()
    {
        return view('frontend.about', [
            'brands' => Brand::active()->latest()->get(),
            'categories' => Category::active()->latest()->get(),
            'products' => Product::active()->withCount('reviews')->withAvg('reviews', 'rating')->latest()->get(),
        ]);
    }

    # search
    public function search(Request $request)
    {
        $search = $request->input('search');
        $products = Product::where('name', 'like', '%' . $search . '%')
            ->active()
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->latest()
            ->get();

        return view('frontend.search', compact('products'));
    }

    // contact_us
    public function contact_us()
    {
        return view('frontend.contact_us');
    }

    public function shop()
    {
        $categories = Category::active()->latest()->get();
        $subcategories = Subcategory::active()->latest()->get();
        $products = Product::active()->withCount('reviews')->withAvg('reviews', 'rating')->latest()->get();

        return view('frontend.shop', compact('categories', 'subcategories', 'products'));
    }

    public function allproduct($category_slug, $subcategory_slug = null)
    {
        $categories = Category::active()->latest()->get();
        $subcategories = Subcategory::active()->latest()->get();
        $productsQuery = Product::active()->withCount('reviews')->withAvg('reviews', 'rating');

        if ($category_slug !== 'all') {
            $category = Category::where('slug', $category_slug)->firstOrFail();
            $productsQuery->where('category_id', $category->id);

            if ($subcategory_slug && $subcategory_slug !== 'null') {
                $subcategory = Subcategory::where('slug', $subcategory_slug)->where('category_id', $category->id)->firstOrFail();
                $productsQuery->where('subcategory_id', $subcategory->id);
            }
        }

        $products = $productsQuery->latest()->get();

        return view('frontend.shop', compact('categories', 'subcategories', 'products'));
    }

    public function product_view_single(Product $product)
    {
        $product->load('photos', 'reviews.user')->loadCount('reviews')->loadAvg('reviews', 'rating');

        $other_products = Product::where('subcategory_id', $product->subcategory_id)
            ->where('id', '!=', $product->id)
            ->active()
            ->withCount('reviews')
            ->withAvg('reviews', 'rating')
            ->latest()
            ->take(5)
            ->get();

        return view('frontend.product', compact('product', 'other_products'));
    }
}
