<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Product_photo;
use App\Models\Subcategory;
use App\Models\Message;
use Auth;
use Carbon\Carbon;
use Image;

class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('checkauth');
    }

    // product page view
    public function index()
    {
        return view('product.product', [
            'products' => Product::latest()->paginate(10),
            'products_count' => Product::count(),
            'product_photos' => Product_photo::all(),
            'product_photos_count' => Product_photo::count(),
        ]);
    }

    // insert page view
    public function addproduct()
    {
        return view('product.addproduct', [
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
        ]);
    }



    public function getsubcategory(Request $req)
    {

        $subcategories = Subcategory::where('category', $req->id)->get();
        $data = "<option value=''>Select</option>";
        foreach ($subcategories as $item) {
            $data .= "<option value='$item->id'>$item->name</option>";
        }
        return $data;
    }

    // insert item
    public function addproductinsert(Request $req)
    {
        $name = $req->name;
        $img = $req->file('img');
        $img_multiple = $req->file('img_multiple');
        $price = $req->price;
        $quantity = $req->quantity;
        $notification_quantity = $req->notification_quantity;
        $discount = $req->discount;
        $category = $req->category;
        $subcategory = $req->subcategory;
        $des = $req->des;
        $added_by = Auth::id();
        $created_at = Carbon::now();

        $req->validate([
            'name' => 'required|string|min:3|max:40',
            'img' => 'required|file|image|mimes:jpeg,jpg,png',
            'img_multiple' => 'required',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'category' => 'required',
            'subcategory' => 'required',
            'des' => 'required|string|min:12',
        ]);
        if ($notification_quantity) {
            $req->validate([
                'notification_quantity' => 'numeric|min:1',
            ]);
        }

        if ($discount) {
            $req->validate([
                'discount' => 'numeric|min:5|max:70',
            ]);
        }


        $id = Product::insertGetId([
            "name" => $name,
            "price" => $price,
            "quantity" => $quantity,
            "category" => $category,
            "subcategory" => $subcategory,
            "des" => $des,
            "added_by" => $added_by,
            "created_at" => $created_at,
        ]);

        $img = $req->file('img');
        $img_extention = $img->getClientOriginalExtension();
        $img_name = $id . "product" . rand(1, 9999) . "." . $img_extention;
        Image::make($img)->save(base_path('public/upload/product/' . $img_name));

        Product::find($id)->update([
            "img" => $img_name,
        ]);

        if ($notification_quantity) {
            Product::find($id)->update([
                "notification_quantity" => $notification_quantity,
            ]);
        }

        if ($discount) {
            Product::find($id)->update([
                "discount" => $discount,
            ]);
        }

        foreach ($img_multiple as $product_photo) {
            $product_photo;
            $img_extention = $product_photo->getClientOriginalExtension();
            $img_name = $id . "product_photo" . rand(1, 9999) . "." . $img_extention;
            Image::make($product_photo)->save(base_path('public/upload/product_photo/' . $img_name));

            Product_photo::insert([
                "img" => $img_name,
                "product" => $id,
                "added_by" => $added_by,
                "created_at" => $created_at,
            ]);
        }

        return redirect('product')->with('success', 'You are success to add a new product');
    }

    // recyclebin page view
    public function recyclebin()
    {
        return view('product.recyclebin_product', [
            'products' => Product::onlyTrashed()->paginate(10),
            'products_count' => Product::onlyTrashed()->count(),
        ]);
    }


    // update_product page view
    public function update_product($id)
    {

        return view('product.update_product', [
            'item' => Product::find($id),
            'categories' => Category::all(),
            'subcategories' => Subcategory::all(),
        ]);
    }
    // update view
    public function update(Request $req)
    {
        $id = $req->id;
        $name = $req->name;
        $price = $req->price;
        $quantity = $req->quantity;
        $notification_quantity = $req->notification_quantity;
        $discount = $req->discount;
        $category = $req->category;
        $subcategory = $req->subcategory;
        $des = $req->des;


        $req->validate([
            'name' => 'required|string|min:3|max:40',
            'price' => 'required|numeric|min:1',
            'quantity' => 'required|numeric|min:1',
            'category' => 'required',
            'subcategory' => 'required',
            'des' => 'required|string|min:12',

        ]);

        if ($notification_quantity != 0) {
            $req->validate([
                'notification_quantity' => 'numeric|min:1',
            ]);
        }

        if ($discount != 0) {
            $req->validate([
                'discount' => 'numeric|min:5|max:70',
            ]);
        }


        if ($notification_quantity != 0) {
            Product::find($id)->update([
                "notification_quantity" => $notification_quantity,
            ]);
        }

        if ($discount != 0) {
            Product::find($id)->update([
                "discount" => $discount,
            ]);
        }

        Product::find($id)->update([
            "name" => $name,
            "price" => $price,
            "quantity" => $quantity,
            "category" => $category,
            "subcategory" => $subcategory,
            "des" => $des,
            "discount" => $discount,
            "notification_quantity" => $notification_quantity,
        ]);
        return back()->with('success', 'You are success to add a new product');
    }
    // img update
    public function img_update(Request $req)
    {
        $req->validate([
            'img' => 'required',
        ]);

        $id = $req->id;
        $old_img = Product::find($id)->img;
        unlink('upload/product/' . $old_img);

        $img = $req->file('img');
        $img_extention = $img->getClientOriginalExtension();
        $img_name = $id . "product" . rand(1, 9999) . "." . $img_extention;
        Image::make($img)->save(base_path('public/upload/product/' . $img_name));

        Product::find($id)->update([
            "img" => $img_name,
        ]);
        return back()->with('success', 'You are success to add a new product');
    }


    // form_action
    public function form_action(Request $req)
    {

        $select_item = $req->check;
        switch ($req->action) {
            case "mark_p_delete":
                foreach ($select_item as $item) {
                    $img = Product::withTrashed()->find($item)->img;
                    unlink('upload/product/' . $img);
                    Product::withTrashed()->find($item)->forceDelete();
                }
                return back()->with('error', 'You all selected item permanent delete');

                break;
            case "mark_s_delete":
                foreach ($select_item as $item) {
                    Product::withTrashed()->find($item)->delete();
                }
                return back()->with('warning', 'You all selected item soft delete');

                break;
            case "mark_restore":
                foreach ($select_item as $item) {
                    Product::withTrashed()->find($item)->restore();
                }
                return back()->with('success', 'You all selected item Restore');

                break;
        }
    }


    // product view

    public function view_product($id)
    {
        return view('product.view_product', [
            'item' => Product::find($id),
            'product_photos' => Product_photo::where('product', $id)->get(),
        ]);
    }





    // soft_delete single
    public function soft_delete($id)
    {
        Product::withTrashed()->find($id)->delete();
        return back()->with('error', 'You are soft all delete your product');
    }

    // p_delete single
    public function p_delete($id)
    {
        $img = Product::withTrashed()->find($id)->img;
        unlink('upload/product/' . $img);
        Product::withTrashed()->find($id)->forceDelete();
        return back()->with('error', 'You are soft all delete your product');
    }

    // restore single
    public function restore($id)
    {
        Product::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'You are success to restore your product');
    }

    // action active deactive
    public function action($id)
    {
        if (Product::find($id)->action == 1) {
            Product::find($id)->update([
                "action" => 2,
            ]);
            return back()->with('warning', 'You are success to deactive your product');
        } else {
            Product::find($id)->update([
                "action" => 1,
            ]);
            return back()->with('success', 'You are success to active your product');
        }
    }

    // soft_delete all
    public function soft_delete_all()
    {
        Product::whereNotNull('id')->delete();
        // Category::truncate();
        return back()->with('error', 'You are soft all delete your product');
    }

    // p_delete all
    public function p_delete_all()
    {
        $items = Product::withTrashed()->get();
        foreach ($items as $item) {
            unlink('upload/product/' . $item->img);
        }
        Product::truncate();
        return back()->with('error', 'You are permanent all delete your product');
    }

    // restore all
    public function restore_all()
    {
        Product::onlyTrashed()->restore();
        return back()->with('success', 'You are success to restore your product');
    }






    // product photo view
    public function view_product_photo($id)
    {

        return view('product.view_product_photo', [
            'id' => $id,
            'product_photos' => Product_photo::where('product', $id)->paginate(10),
            'product_photos_count' => Product_photo::where('product', $id)->count(),
        ]);
    }

    // action_product_photo active deactive
    public function action_product_photo($id)
    {
        if (Product_photo::find($id)->action == 1) {
            Product_photo::find($id)->update([
                "action" => 2,
            ]);
            return back()->with('warning', 'You are success to deactive your product');
        } else {
            Product_photo::find($id)->update([
                "action" => 1,
            ]);
            return back()->with('success', 'You are success to active your product');
        }
    }


    // delete_product_photo single
    public function delete_product_photo($id)
    {
        $img = Product_photo::find($id)->img;
        unlink('upload/product_photo/' . $img);
        Product_photo::find($id)->forceDelete();
        return back()->with('error', 'You are soft all delete your product');
    }

    // p_delete all
    public function product_photo_delete_all()
    {
        $items = Product_photo::all();
        foreach ($items as $item) {
            unlink('upload/product_photo/' . $item->img);
        }
        Product_photo::truncate();
        return back()->with('error', 'You are permanent all delete your product');
    }


    // addproductphoto page view
    public function addproductphoto($id)
    {
        return view('product.addproductphoto', [
            'id' => $id,
        ]);
    }


    // insert item
    public function addproductphotoinsert(Request $req)
    {
        $req->validate([
            'img_multiple' => 'required',
        ]);

        $id = $req->product_id;
        $img_multiple = $req->file('img_multiple');
        $added_by = Auth::id();
        $created_at = Carbon::now();



        foreach ($img_multiple as $product_photo) {
            $product_photo;
            $img_extention = $product_photo->getClientOriginalExtension();
            $img_name = $id . "product_photo" . rand(1, 9999) . "." . $img_extention;
            Image::make($product_photo)->save(base_path('public/upload/product_photo/' . $img_name));

            Product_photo::insert([
                "img" => $img_name,
                "product" => $id,
                "added_by" => $added_by,
                "created_at" => $created_at,

            ]);
        }
        return redirect('product')->with('success', 'You are success to add a new product');
    }
}
