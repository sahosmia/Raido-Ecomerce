<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Subcategory;
use Auth;
use App\Http\Requests\SubcategoryStoreRequest;
use App\Http\Requests\SubcategoryUpdateRequest;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('subcategory.index', [
            'subcategories' => Subcategory::with('category_info', 'user')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('subcategory.create', [
            'categories' => Category::latest()->get(),
        ]);
    }

    public function store(SubcategoryStoreRequest $request)
    {
        $inputs = $request->validated();
        $inputs['added_by'] = Auth::id();
        $inputs['category'] = $request->category_id;

        Subcategory::create($inputs);
        return redirect()->route('admin.subcategories.index')->with('success', 'Successfully added a new subcategory.');
    }

    public function edit(Subcategory $subcategory)
    {
        return view('subcategory.edit', [
            'item' => $subcategory,
            'categories' => Category::latest()->get(),
        ]);
    }

    public function update(SubcategoryUpdateRequest $request, Subcategory $subcategory)
    {
        $inputs = $request->validated();
        $inputs['category'] = $request->category_id;

        $subcategory->update($inputs);
        return redirect()->route('admin.subcategories.index')->with('success', 'Successfully updated the subcategory.');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return back()->with('success', 'Subcategory successfully moved to trash.');
    }

    public function trashed()
    {
        return view('subcategory.trashed', [
            'subcategories' => Subcategory::onlyTrashed()->with('category_info', 'user')->latest()->paginate(10),
        ]);
    }

    public function restore($id)
    {
        Subcategory::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'Successfully restored the subcategory.');
    }

    public function forceDelete($id)
    {
        Subcategory::withTrashed()->findOrFail($id)->forceDelete();
        return back()->with('success', 'Permanently deleted the subcategory.');
    }
}