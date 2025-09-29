<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Auth;
use Carbon\Carbon;
use App\Http\Requests\SubcategoryStoreRequest;
use App\Http\Requests\SubcategoryUpdateRequest;
use Image;


use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('checkauth');
    }

    // subcategory page view
    public function index()
    {
        return view('subcategory.subcategory', [
            'subcategories' => Subcategory::latest()->paginate(10),
            'subcategories_count' => Subcategory::count(),
        ]);
    }

    // insert page view
    public function addsubcategory()
    {
        return view('subcategory.addsubcategory', [
            'categories' => Category::all(),
        ]);
    }

    // insert item
    public function addsubcategoryinsert(SubcategoryStoreRequest $req)
    {
        $name = $req->name;
        $category = $req->category_id;
        $added_by = Auth::id();
        $created_at = Carbon::now();

        Subcategory::insert([
            "name" => $name,
            "category" => $category,
            "added_by" => $added_by,
            "created_at" => $created_at,
        ]);
        return redirect('subcategory')->with('success', 'You are success to add a new subcategory');
    }

    // recyclebin page view
    public function recyclebin()
    {
        return view('subcategory.recyclebin_subcategory', [
            'subcategories' => Subcategory::onlyTrashed()->paginate(10),
            'subcategories_count' => Subcategory::onlyTrashed()->count(),
        ]);
    }

    // update view
    public function update(SubcategoryUpdateRequest $req)
    {
        $name = $req->name;
        $category = $req->category_id;
        $id = $req->id;

        Subcategory::find($id)->update([
            "name" => $name,
            "category" => $category,
        ]);
        return back()->with('success', 'You are success to add a new subcategory');
    }



    // form_action
    public function form_action(Request $req)
    {

        $select_item = $req->check;
        switch ($req->action) {
            case "mark_p_delete":
                foreach ($select_item as $item) {
                    Subcategory::withTrashed()->find($item)->forceDelete();
                }
                return back()->with('error', 'You all selected item permanent delete');

                break;
            case "mark_s_delete":
                foreach ($select_item as $item) {
                    Subcategory::withTrashed()->find($item)->delete();
                }
                return back()->with('warning', 'You all selected item soft delete');

                break;
            case "mark_restore":
                foreach ($select_item as $item) {
                    Subcategory::withTrashed()->find($item)->restore();
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

    // update_subcategory page view
    public function update_subcategory($id)
    {
        return view('subcategory.update_subcategory', [
            'item' => Subcategory::find($id),
            'categories' => Category::all(),
        ]);
    }

    // soft_delete single
    public function soft_delete($id)
    {
        Subcategory::withTrashed()->find($id)->delete();
        return back()->with('error', 'You are soft all delete your subcategory');
    }

    // p_delete single
    public function p_delete($id)
    {
        Subcategory::withTrashed()->find($id)->forceDelete();
        return back()->with('error', 'You are soft all delete your subcategory');
    }

    // restore single
    public function restore($id)
    {
        Subcategory::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'You are success to restore your subcategory');
    }

    // action active deactive
    public function action($id)
    {
        if (Subcategory::find($id)->action == 1) {
            Subcategory::find($id)->update([
                "action" => 2,
            ]);
            return back()->with('warning', 'You are success to deactive your subcategory');
        } else {
            Subcategory::find($id)->update([
                "action" => 1,
            ]);
            return back()->with('success', 'You are success to active your subcategory');
        }
    }

    // soft_delete all
    public function soft_delete_all()
    {
        Subcategory::whereNotNull('id')->delete();
        // Category::truncate();
        return back()->with('error', 'You are soft all delete your subcategory');
    }

    // p_delete all
    public function p_delete_all()
    {
        Subcategory::truncate();
        return back()->with('error', 'You are permanent all delete your subcategory');
    }

    // restore all
    public function restore_all()
    {
        Subcategory::onlyTrashed()->restore();
        return back()->with('success', 'You are success to restore your subcategory');
    }
}
