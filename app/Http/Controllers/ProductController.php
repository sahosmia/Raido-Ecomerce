<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Http\Requests\ProductStoreRequest;
use App\Http\Requests\ProductUpdateRequest;
use App\Http\Requests\ProductPhotoInsertRequest;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_photo;
use App\Models\Subcategory;
use Auth;
use Image;
use Illuminate\Support\Facades\File;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('product.index', [
            'products' => Product::with('category_info', 'subcategory_info', 'user', 'photos')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('product.create', [
            'categories' => Category::latest()->get(),
        ]);
    }

    public function store(ProductStoreRequest $request)
    {
        $inputs = $request->validated();
        $inputs['added_by'] = Auth::id();

        $product = Product::create($inputs);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = $product->id . '.' . $image->getClientOriginalExtension();
            $location = public_path('upload/product/' . $filename);
            Image::make($image)->save($location);
            $product->update(['img' => $filename]);
        }

        if ($request->hasFile('img_multiple')) {
            $photos = [];
            foreach ($request->file('img_multiple') as $product_photo) {
                $img_extention = $product_photo->getClientOriginalExtension();
                $img_name = $product->id . "_product_photo_" . rand(1, 9999) . "." . $img_extention;
                Image::make($product_photo)->save(public_path('upload/product_photo/' . $img_name));

                $photos[] = [
                    "img" => $img_name,
                    "product" => $product->id,
                    "added_by" => Auth::id(),
                    "created_at" => now(),
                    "updated_at" => now(),
                ];
            }
            Product_photo::insert($photos);
        }

        return redirect()->route('admin.products.index')->with('success', 'You have successfully added a new product.');
    }

    public function show(Product $product)
    {
        $product->load('photos');
        return view('product.show', [
            'item' => $product,
            'product_photos' => $product->photos,
        ]);
    }

    public function edit(Product $product)
    {
        return view('product.edit', [
            'item' => $product,
            'categories' => Category::latest()->get(),
            'subcategories' => Subcategory::where('category', $product->category)->get(),
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $inputs = $request->validated();

        if ($request->hasFile('img')) {
            $old_img_path = public_path('upload/product/' . $product->img);
            if ($product->img && File::exists($old_img_path)) {
                File::delete($old_img_path);
            }
            $image = $request->file('img');
            $filename = $product->id . '.' . $image->getClientOriginalExtension();
            $location = public_path('upload/product/' . $filename);
            Image::make($image)->save($location);
            $inputs['img'] = $filename;
        }

        $product->update($inputs);

        return redirect()->route('admin.products.index')->with('success', 'You have successfully updated the product.');
    }

    public function destroy(Product $product)
    {
        $product->delete();
        return back()->with('success', 'Product successfully moved to trash.');
    }

    public function trashed()
    {
        return view('product.trashed', [
            'products' => Product::onlyTrashed()->with('category_info', 'subcategory_info', 'user')->latest()->paginate(10),
        ]);
    }

    public function restore($id)
    {
        Product::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'You have successfully restored the product.');
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->with('photos')->findOrFail($id);

        $img_path = public_path('upload/product/' . $product->img);
        if ($product->img && File::exists($img_path)) {
            File::delete($img_path);
        }

        foreach ($product->photos as $photo) {
            $photo_img_path = public_path('upload/product_photo/' . $photo->img);
            if ($photo->img && File::exists($photo_img_path)) {
                File::delete($photo_img_path);
            }
        }
        $product->photos()->delete();

        $product->forceDelete();
        return back()->with('success', 'You have permanently deleted the product.');
    }

    public function getSubcategories(Request $request)
    {
        $subcategories = Subcategory::where('category', $request->id)->get();
        return response()->json($subcategories);
    }

    public function view_product_photo(Product $product)
    {
        return view('product.photos.index', [
            'product' => $product,
            'product_photos' => $product->photos()->paginate(10),
        ]);
    }

    public function addproductphoto(Product $product)
    {
        return view('product.photos.create', [
            'product' => $product,
        ]);
    }

    public function addproductphotoinsert(ProductPhotoInsertRequest $request, Product $product)
    {
        $photos = [];
        foreach ($request->file('img_multiple') as $product_photo) {
            $img_extention = $product_photo->getClientOriginalExtension();
            $img_name = $product->id . "_product_photo_" . rand(1, 9999) . "." . $img_extention;
            Image::make($product_photo)->save(public_path('upload/product_photo/' . $img_name));

            $photos[] = [
                "img" => $img_name,
                "product" => $product->id,
                "added_by" => Auth::id(),
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }
        Product_photo::insert($photos);
        return redirect()->route('admin.products.photos.index', $product->id)->with('success', 'You have successfully added new photos.');
    }

    public function delete_product_photo(Product_photo $photo)
    {
        $img_path = public_path('upload/product_photo/' . $photo->img);
        if ($photo->img && File::exists($img_path)) {
            File::delete($img_path);
        }
        $photo->delete();
        return back()->with('success', 'You have deleted the product photo.');
    }
}