<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->middleware('auth');
        $this->brandService = $brandService;
    }

    public function index()
    {
        return view('brand.index', [
            'brands' => $this->brandService->getAllBrands(10),
        ]);
    }

    public function create()
    {
        return view('brand.create');
    }

    public function store(BrandStoreRequest $request)
    {
        $this->brandService->createBrand($request->validated(), $request->file('img'));
        return redirect()->route('admin.brands.index')->with('success', 'You have successfully added a new brand.');
    }

    public function edit(Brand $brand)
    {
        return view('brand.edit', [
            'item' => $brand,
        ]);
    }

    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $this->brandService->updateBrand($brand->id, $request->validated(), $request->file('img'));
        return redirect()->route('admin.brands.index')->with('success', 'You have successfully updated the brand.');
    }

    public function destroy(Brand $brand)
    {
        $this->brandService->deleteBrand($brand->id);
        return back()->with('success', 'Brand successfully moved to trash.');
    }

    public function trashed()
    {
        return view('brand.trashed', [
            'brands' => $this->brandService->getTrashedBrands(10),
        ]);
    }

    public function restore($id)
    {
        $this->brandService->restoreBrand($id);
        return back()->with('success', 'You have successfully restored the brand.');
    }

    public function forceDelete($id)
    {
        $this->brandService->forceDeleteBrand($id);
        return back()->with('success', 'You have permanently deleted the brand.');
    }
}