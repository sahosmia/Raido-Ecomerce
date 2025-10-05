<?php

namespace App\Http\Controllers;

use App\Http\Requests\CategoryStoreRequest;
use App\Http\Requests\CategoryUpdateRequest;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->middleware('auth');
        $this->categoryService = $categoryService;
    }

    public function index()
    {
        return view('backend.category.index', [
            'categories' => $this->categoryService->getAllCategories(10),
        ]);
    }

    public function create()
    {
        return view('backend.category.create');
    }

    public function store(CategoryStoreRequest $request)
    {
        $this->categoryService->createCategory($request->validated(), $request->file('img'));
        return redirect()->route('admin.categories.index')->with('success', 'Successfully added a new category.');
    }

    public function edit(Category $category)
    {
        return view('backend.category.edit', [
            'item' => $category,
        ]);
    }

    public function update(CategoryUpdateRequest $request, Category $category)
    {
        $this->categoryService->updateCategory($category, $request->validated(), $request->file('img'));
        return back()->with('success', 'Successfully updated the category.');
    }

    public function destroy(Category $category)
    {
        $this->categoryService->deleteCategory($category);
        return back()->with('success', 'Category successfully moved to trash.');
    }

    public function trashed()
    {
        return view('backend.category.trashed', [
            'categories' => $this->categoryService->getTrashedCategories(10),
        ]);
    }

    public function restore(Category $category)
    {
        $this->categoryService->restoreCategory($category);
        return back()->with('success', 'Successfully restored the category.');
    }

    public function forceDelete(Category $category)
    {
        $this->categoryService->forceDeleteCategory($category);
        return back()->with('success', 'Permanently deleted the category.');
    }
}