<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Image;


use Illuminate\Http\Request;

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
        ]);
    }

    public function create()
    {
        return view('category.addcategory');
    }

     public function store(CategoryStoreRequest $req)
    {
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
        $img_name = $id . "category" . rand(1, 9999) . "." . $img_extention;
        Image::make($img)->save(base_path('public/upload/category/' . $img_name));

        Category::find($id)->update([
            "img" => $img_name,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'You are success to add a new category');
    }

    public function edit($id)
    {
        return view('category.update_category', [
            'item' => Category::find($id),
        ]);
    }

    public function update(CategoryUpdateRequest $request,$id)
    {
        $inputs = $request->only('name');

        if($request->hasFile('img'))
        {
            $old_img = Category::find($id)->img;
            unlink('upload/category/' . $old_img);

            $image = $request->file('img');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('upload/category/'.$filename);
            Image::make($image)->save($location);
            $inputs['img'] =  $filename;
        }

        Category::where(['id'=>$id])->update($inputs);
        return back()->with('success', 'You are success to update your category item.');
    }



    // recyclebin page view
    public function recyclebin()
    {
        return view('category.recyclebin_category', [
            'categories' => Category::onlyTrashed()->paginate(10),
            'categories_count' => Category::onlyTrashed()->count(),
        ]);
    }

    // update view




    // form_action
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

    // restore all
    public function restore_all()
    {
        Category::onlyTrashed()->restore();
        return back()->with('success', 'You are success to restore your category');
    }
}
