<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;
use Auth;
use Carbon\Carbon;
use Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('checkauth');
    }

    // brand page view
    public function index()
    {
        return view('brand.brand', [
            'brands' => Brand::latest()->paginate(10),
            'brands_count' => Brand::count(),
        ]);
    }

    // insert page view
    public function addbrand()
    {
        return view('brand.addbrand');
    }

    // insert item
    public function addbrandinsert(Request $req)
    {

        $req->validate([
            'name' => 'required|unique:brands,name',
            'img' => 'required',
        ]);

        $name = $req->name;
        $added_by = Auth::id();
        $created_at = Carbon::now();

        $id = Brand::insertGetId([
            "name" => $name,
            "added_by" => $added_by,
            "created_at" => $created_at,
        ]);

        $img = $req->file('img');
        $img_extention = $img->getClientOriginalExtension();
        $img_name = $id . "brand" . rand(1, 9999) . "." . $img_extention;
        Image::make($img)->save(base_path('public/upload/brand/' . $img_name));

        Brand::find($id)->update([
            "img" => $img_name,
        ]);

        return redirect('brand')->with('success', 'You are success to add a new brand');
    }

    // recyclebin page view
    public function recyclebin()
    {
        return view('brand.recyclebin_brand', [
            'brands' => Brand::onlyTrashed()->paginate(10),
            'brands_count' => Brand::onlyTrashed()->count(),
        ]);
    }

    // update view
    public function update(Request $req)
    {
        $req->validate([
            'name' => 'required',
        ]);

        $name = $req->name;
        $id = $req->id;

        Brand::find($id)->update([
            "name" => $name,
        ]);
        return back()->with('success', 'You are success to add a new brand');
    }
    // img update
    public function img_update(Request $req)
    {

        $req->validate([
            'img' => 'required',
        ]);

        $id = $req->id;
        $old_img = Brand::find($id)->img;
        unlink('upload/brand/' . $old_img);

        $img = $req->file('img');
        $img_extention = $img->getClientOriginalExtension();
        $img_name = $id . rand(1, 9999) . "." . $img_extention;
        Image::make($img)->save(base_path('public/upload/brand/' . $img_name));

        Brand::find($id)->update([
            "img" => $img_name,
        ]);

        Brand::find($id)->update([
            "img" => $img_name,
        ]);
        return back()->with('success', 'You are success to add a new brand');
    }


    // form_action
    public function form_action(Request $req)
    {

        $select_item = $req->check;
        switch ($req->action) {
            case "mark_p_delete":
                foreach ($select_item as $item) {
                    $img = brand::withTrashed()->find($item)->img;
                    unlink('upload/brand/' . $img);
                    Brand::withTrashed()->find($item)->forceDelete();
                }
                return back()->with('error', 'You all selected item permanent delete');

                break;
            case "mark_s_delete":
                foreach ($select_item as $item) {
                    Brand::withTrashed()->find($item)->delete();
                }
                return back()->with('warning', 'You all selected item soft delete');

                break;
            case "mark_restore":
                foreach ($select_item as $item) {
                    Brand::withTrashed()->find($item)->restore();
                }
                return back()->with('success', 'You all selected item Restore');

                break;
        }
    }




    /* view id page
    .
    .
    .
    .
    .
    .
    .view id page
    .
    .
    .
    .
    view id page
    */

    // update_brand page view
    public function update_brand($id)
    {
        return view('brand.update_brand', [
            'item' => Brand::find($id),
        ]);
    }

    // soft_delete single
    public function soft_delete($id)
    {
        Brand::withTrashed()->find($id)->delete();
        return back()->with('error', 'You are soft all delete your brand');
    }

    // p_delete single
    public function p_delete($id)
    {
        $img = brand::withTrashed()->find($id)->img;
        unlink('upload/brand/' . $img);
        Brand::withTrashed()->find($id)->forceDelete();
        return back()->with('error', 'You are soft all delete your brand');
    }

    // restore single
    public function restore($id)
    {
        Brand::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'You are success to restore your brand');
    }

    // action active deactive
    public function action($id)
    {
        if (Brand::find($id)->action == 1) {
            Brand::find($id)->update([
                "action" => 2,
            ]);
            return back()->with('warning', 'You are success to deactive your brand');
        } else {
            Brand::find($id)->update([
                "action" => 1,
            ]);
            return back()->with('success', 'You are success to active your brand');
        }
    }

    // soft_delete all
    public function soft_delete_all()
    {
        Brand::whereNotNull('id')->delete();
        // Category::truncate();
        return back()->with('error', 'You are soft all delete your brand');
    }

    // p_delete all
    public function p_delete_all()
    {
        $items = Brand::withTrashed()->get();
        foreach ($items as $item) {
            unlink('upload/brand/' . $item->img);
        }
        Brand::truncate();
        return back()->with('error', 'You are permanent all delete your brand');
    }

    // restore all
    public function restore_all()
    {
        Brand::onlyTrashed()->restore();
        return back()->with('success', 'You are success to restore your brand');
    }
}
