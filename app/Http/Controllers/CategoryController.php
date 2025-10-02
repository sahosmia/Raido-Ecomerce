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
    }

    public function index()
    {
        return view('category.index', [
            'categories' => Category::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('category.create');
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

    public function edit(Category $category)
    {
        return view('category.edit', [
            'item' => $category,
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $inputs = $request->only('name');

        if($request->hasFile('img'))
        {
            $old_img = $category->img;
            if ($old_img && file_exists(public_path('upload/category/' . $old_img))) {
                unlink(public_path('upload/category/' . $old_img));
            }

            $image = $request->file('img');
            $filename = time().'.'.$image->getClientOriginalExtension();
            $location = public_path('upload/category/'.$filename);
            Image::make($image)->save($location);
            $inputs['img'] =  $filename;
        }

        $category->update($inputs);
        return back()->with('success', 'You are success to update your category item.');
    }

    public function destroy(Category $category)
    {
        $category->delete(); // Soft delete
        return back()->with('success', 'Category successfully moved to trash.');
    }

    public function trashed()
    {
        return view('category.trashed', [
            'categories' => Category::onlyTrashed()->paginate(10),
            'categories_count' => Category::onlyTrashed()->count(),
        ]);
    }

    public function restore($id)
    {
        Category::withTrashed()->find($id)->restore();
        return back()->with('success', 'You have successfully restored the category.');
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->find($id);
        $img = $category->img;
        if ($img && file_exists(public_path('upload/category/' . $img))) {
            unlink(public_path('upload/category/' . $img));
        }
        $category->forceDelete();
        return back()->with('success', 'You have permanently deleted the category.');
    }
}