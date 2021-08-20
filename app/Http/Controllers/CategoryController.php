<?php

namespace App\Http\Controllers;

use App\Models\Category;


use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('checkauth');
    }

    public function index()
    {
        return view('category.category', [
            'categories' => Category::latest()->paginate(10),
            'categories_count' => Category::count(),

        ]);
    }

    // insert page view
    public function addcategory()
    {
        return view('category.addcategory');
    }

    // insert item
    public function addcategoryinsert(Request $req)
    {
        $req->validate([
            'name' => 'required|unique:categories,name',
            'img' => 'required',
        ]);

        $name = $req->name;
        $added_by = Auth::id();
        $created_at = Carbon::now();

        $id = Category::insertGetId([
            "name" => $name,
            "added_by" => $added_by,
            "created_at" => $created_at,
        ]);

        $img = $req->file('img');
        $img_extention = $img->getClientOriginalExtension();
        $img_name = $id . rand(1, 9999) . "." . $img_extention;
        Image::make($img)->save(base_path('public/upload/category/' . $img_name));

        Category::find($id)->update([
            "img" => $img_name,
        ]);

        return redirect('category')->with('success', 'You are success to add a new category');
    }

    // recyclebin page view
    public function update_category($id)
    {
        return view('category.update_category', [
            'item' => Category::find($id),
        ]);
    }
    
    public function update(Request $req)
    {
        $req->validate([
            'name' => 'required|unique:categories,name',
        ]);

        $name = $req->name;
        $id = $req->id;

        Category::find($id)->update([
            "name" => $name,
        ]);
        return back()->with('success', 'You are success to add a new category');
    }

    public function img_update(Request $req)
    {

        $req->validate([
            'img' => 'required',
        ]);

        $id = $req->id;
        $old_img = Category::find($id)->img;
        unlink('upload/category/' . $old_img);

        $img = $req->file('img');
        $img_extention = $img->getClientOriginalExtension();
        $img_name = $id . rand(1, 9999) . "." . $img_extention;
        Image::make($img)->save(base_path('public/upload/category/' . $img_name));

        Category::find($id)->update([
            "img" => $img_name,
        ]);

        Category::find($id)->update([
            "img" => $img_name,
        ]);
        return back()->with('success', 'You are success to add a new category');
    }

    // recyclebin page view
    public function recyclebin($id)
    {
        return view('category.update_category', [
            'categories' => Category::onlyTrashed()->paginate(10),
            'categories_count' => Category::onlyTrashed()->count(),
        ]);
    }

    // soft_delete single
    public function soft_delete($id)
    {
        Category::withTrashed()->find($id)->delete();
        return back()->with('error', 'You are soft all delete your category');
    }

    // p_delete single
    public function p_delete($id)
    {
        // die();
        $img = Category::withTrashed()->find($id)->img;
        unlink('upload/category/' . $img);
        Category::withTrashed()->find($id)->forceDelete();
        return back()->with('error', 'You are soft all delete your category');
    }

    // soft_delete all
    public function soft_delete_all()
    {
        Category::whereNotNull('id')->delete();
        // Category::truncate();
        return back()->with('error', 'You are soft all delete your category');
    }

    // p_delete all
    public function p_delete_all()
    {
        $items = Category::withTrashed()->get();
        foreach ($items as $item) {
            unlink('upload/category/' . $item->img);
        }
        Category::truncate();
        return back()->with('error', 'You are permanent all delete your category');
    }

    // restore single
    public function restore($id)
    {
        Category::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'You are success to restore your category');
    }

    // action active deactive
    public function action($id)
    {
        if (Category::find($id)->action == 1) {
            Category::find($id)->update([
                "action" => 2,
            ]);
            return back()->with('warning', 'You are success to deactive your category');
        } else {
            Category::find($id)->update([
                "action" => 1,
            ]);
            return back()->with('success', 'You are success to active your category');
        }
    }

    public function form_action(Request $req)
    {

        $select_item = $req->check;
        switch ($req->action) {
            case "mark_p_delete":
                foreach ($select_item as $item) {
                    $img = Category::withTrashed()->find($item)->img;
                    unlink('upload/category/' . $img);
                    Category::withTrashed()->find($item)->forceDelete();
                }
                return back()->with('error', 'You all selected item permanent delete');

                break;
            case "mark_s_delete":
                foreach ($select_item as $item) {
                    Category::withTrashed()->find($item)->delete();
                }
                return back()->with('warning', 'You all selected item soft delete');

                break;
            case "mark_restore":
                foreach ($select_item as $item) {
                    Category::withTrashed()->find($item)->restore();
                }
                return back()->with('success', 'You all selected item Restore');

                break;
        }
    }
}
