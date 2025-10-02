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
        return view('subcategory.subcategory', [
            'subcategories' => Subcategory::with('category_info')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('subcategory.addsubcategory', [
            'categories' => Category::all(),
        ]);
    }

    public function store(SubcategoryStoreRequest $request)
    {
        Subcategory::create([
            'name' => $request->name,
            'category' => $request->category_id,
            'added_by' => Auth::id(),
        ]);
        return redirect()->route('admin.subcategories.index')->with('success', 'You have successfully added a new subcategory.');
    }

    public function edit(Subcategory $subcategory)
    {
        return view('subcategory.update_subcategory', [
            'item' => $subcategory,
            'categories' => Category::all(),
        ]);
    }

    public function update(SubcategoryUpdateRequest $request, Subcategory $subcategory)
    {
        $subcategory->update([
            'name' => $request->name,
            'category' => $request->category_id,
        ]);
        return redirect()->route('admin.subcategories.index')->with('success', 'You have successfully updated the subcategory.');
    }

    public function destroy(Subcategory $subcategory)
    {
        $subcategory->delete();
        return back()->with('success', 'Subcategory successfully moved to trash.');
    }

    public function trashed()
    {
        return view('subcategory.recyclebin_subcategory', [
            'subcategories' => Subcategory::onlyTrashed()->with('category_info')->paginate(10),
        ]);
    }

    public function restore($id)
    {
        Subcategory::withTrashed()->find($id)->restore();
        return back()->with('success', 'You have successfully restored the subcategory.');
    }

    public function forceDelete($id)
    {
        Subcategory::withTrashed()->find($id)->forceDelete();
        return back()->with('success', 'You have permanently deleted the subcategory.');
    }
}