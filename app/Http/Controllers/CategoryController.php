<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Auth;
use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use Image;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('category.index', [
            'categories' => Category::with('user')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('category.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $inputs = $request->validated();
        $inputs['added_by'] = Auth::id();

        $category = Category::create($inputs);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = $category->id . '_category_' . time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('upload/category/' . $filename);
            Image::make($image)->save($location);
            $category->update(['img' => $filename]);
        }

        return redirect()->route('admin.categories.index')->with('success', 'Successfully added a new category.');
    }

    public function edit(Category $category)
    {
        return view('category.edit', [
            'item' => $category,
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $inputs = $request->validated();

        if ($request->hasFile('img')) {
            $old_img_path = public_path('upload/category/' . $category->img);
            if ($category->img && File::exists($old_img_path)) {
                File::delete($old_img_path);
            }

            $image = $request->file('img');
            $filename = $category->id . '_category_' . time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('upload/category/' . $filename);
            Image::make($image)->save($location);
            $inputs['img'] = $filename;
        }

        $category->update($inputs);
        return back()->with('success', 'Successfully updated the category.');
    }

    public function destroy(Category $category)
    {
        $category->delete(); // Soft delete
        return back()->with('success', 'Category successfully moved to trash.');
    }

    public function trashed()
    {
        $categories = Category::onlyTrashed()->with('user')->latest()->paginate(10);
        return view('category.trashed', compact('categories'));
    }

    public function restore($id)
    {
        Category::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Successfully restored the category.');
    }

    public function forceDelete($id)
    {
        $category = Category::withTrashed()->findOrFail($id);

        $img_path = public_path('upload/category/' . $category->img);
        if ($category->img && File::exists($img_path)) {
            File::delete($img_path);
        }

        $category->forceDelete();
        return back()->with('success', 'Permanently deleted the category.');
    }
}