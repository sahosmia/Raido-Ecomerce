<?php

namespace App\Http\Controllers;

use App\Http\Requests\SubcategoryStoreRequest;
use App\Http\Requests\SubcategoryUpdateRequest;
use App\Models\Subcategory;
use App\Services\SubcategoryService;
use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    protected $subcategoryService;

    public function __construct(SubcategoryService $subcategoryService)
    {
        $this->middleware('auth');
        $this->subcategoryService = $subcategoryService;
    }

    public function index()
    {
        return view('subcategory.index', [
            'subcategories' => $this->subcategoryService->getAllSubcategories(10),
        ]);
    }

    public function create()
    {
        return view('subcategory.create', [
            'categories' => $this->subcategoryService->getAllCategories(),
        ]);
    }

    public function store(SubcategoryStoreRequest $request)
    {
        $this->subcategoryService->createSubcategory($request->validated());
        return redirect()->route('admin.subcategories.index')->with('success', 'Successfully added a new subcategory.');
    }

    public function edit(Subcategory $subcategory)
    {
        return view('subcategory.edit', [
            'item' => $subcategory,
            'categories' => $this->subcategoryService->getAllCategories(),
        ]);
    }

    public function update(SubcategoryUpdateRequest $request, Subcategory $subcategory)
    {
        $this->subcategoryService->updateSubcategory($subcategory->id, $request->validated());
        return redirect()->route('admin.subcategories.index')->with('success', 'Successfully updated the subcategory.');
    }

    public function destroy(Subcategory $subcategory)
    {
        $this->subcategoryService->deleteSubcategory($subcategory->id);
        return back()->with('success', 'Subcategory successfully moved to trash.');
    }

    public function trashed()
    {
        return view('subcategory.trashed', [
            'subcategories' => $this->subcategoryService->getTrashedSubcategories(10),
        ]);
    }

    public function restore($id)
    {
        $this->subcategoryService->restoreSubcategory($id);
        return back()->with('success', 'Successfully restored the subcategory.');
    }

    public function forceDelete($id)
    {
        $this->subcategoryService->forceDeleteSubcategory($id);
        return back()->with('success', 'Permanently deleted the subcategory.');
    }
}