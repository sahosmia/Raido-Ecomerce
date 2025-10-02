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

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('product.product', [
            'products' => Product::with('category_info', 'subcategory_info', 'user', 'photos')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('product.addproduct', [
            'categories' => Category::all(),
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
            foreach ($request->file('img_multiple') as $product_photo) {
                $img_extention = $product_photo->getClientOriginalExtension();
                $img_name = $product->id . "_product_photo_" . rand(1, 9999) . "." . $img_extention;
                Image::make($product_photo)->save(base_path('public/upload/product_photo/' . $img_name));

                Product_photo::create([
                    "img" => $img_name,
                    "product" => $product->id,
                    "added_by" => Auth::id(),
                ]);
            }
        }

        return redirect()->route('admin.products.index')->with('success', 'You have successfully added a new product.');
    }

    public function show(Product $product)
    {
        return view('product.view_product', [
            'item' => $product,
            'product_photos' => $product->photos,
        ]);
    }

    public function edit(Product $product)
    {
        return view('product.update_product', [
            'item' => $product,
            'categories' => Category::all(),
            'subcategories' => Subcategory::where('category', $product->category)->get(),
        ]);
    }

    public function update(ProductUpdateRequest $request, Product $product)
    {
        $inputs = $request->validated();

        if ($request->hasFile('img')) {
            $old_img = $product->img;
            if ($old_img && file_exists(public_path('upload/product/' . $old_img))) {
                unlink(public_path('upload/product/' . $old_img));
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
        return view('product.recyclebin_product', [
            'products' => Product::onlyTrashed()->with('category_info', 'subcategory_info', 'user')->paginate(10),
        ]);
    }

    public function restore($id)
    {
        Product::withTrashed()->find($id)->restore();
        return back()->with('success', 'You have successfully restored the product.');
    }

    public function forceDelete($id)
    {
        $product = Product::withTrashed()->find($id);

        $img = $product->img;
        if ($img && file_exists(public_path('upload/product/' . $img))) {
            unlink(public_path('upload/product/' . $img));
        }

        foreach ($product->photos as $photo) {
            $photo_img = $photo->img;
            if ($photo_img && file_exists(public_path('upload/product_photo/' . $photo_img))) {
                unlink(public_path('upload/product_photo/' . $photo_img));
            }
            $photo->delete();
        }

        $product->forceDelete();
        return back()->with('success', 'You have permanently deleted the product.');
    }

    public function getSubcategories(Request $request)
    {
        $subcategories = Subcategory::where('category', $request->id)->get();
        $data = "<option value=''>Select</option>";
        foreach ($subcategories as $item) {
            $data .= "<option value='$item->id'>$item->name</option>";
        }
        return $data;
    }

    public function view_product_photo(Product $product)
    {
        return view('product.view_product_photo', [
            'product' => $product,
            'product_photos' => $product->photos()->paginate(10),
        ]);
    }

    public function addproductphoto(Product $product)
    {
        return view('product.addproductphoto', [
            'product' => $product,
        ]);
    }

    public function addproductphotoinsert(ProductPhotoInsertRequest $request, Product $product)
    {
        foreach ($request->file('img_multiple') as $product_photo) {
            $img_extention = $product_photo->getClientOriginalExtension();
            $img_name = $product->id . "_product_photo_" . rand(1, 9999) . "." . $img_extention;
            Image::make($product_photo)->save(base_path('public/upload/product_photo/' . $img_name));

            Product_photo::create([
                "img" => $img_name,
                "product" => $product->id,
                "added_by" => Auth::id(),
            ]);
        }
        return redirect()->route('admin.products.photos.index', $product->id)->with('success', 'You have successfully added new photos.');
    }

    public function delete_product_photo(Product_photo $photo)
    {
        $img = $photo->img;
        if ($img && file_exists(public_path('upload/product_photo/' . $img))) {
            unlink(public_path('upload/product_photo/' . $img));
        }
        $photo->delete();
        return back()->with('success', 'You have deleted the product photo.');
    }
}