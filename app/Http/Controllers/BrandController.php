<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use Auth;
use Illuminate\Http\Request;
use Image;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('brand.brand', [
            'brands' => Brand::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('brand.addbrand');
    }

    public function store(BrandStoreRequest $request)
    {
        $inputs = $request->validated();
        $inputs['added_by'] = Auth::id();

        $brand = Brand::create($inputs);

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = $brand->id . '.' . $image->getClientOriginalExtension();
            $location = public_path('upload/brand/' . $filename);
            Image::make($image)->save($location);
            $brand->update(['img' => $filename]);
        }

        return redirect()->route('admin.brands.index')->with('success', 'You have successfully added a new brand.');
    }

    public function edit(Brand $brand)
    {
        return view('brand.update_brand', [
            'item' => $brand,
        ]);
    }

    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $inputs = $request->validated();

        if ($request->hasFile('img')) {
            $old_img = $brand->img;
            if ($old_img && file_exists(public_path('upload/brand/' . $old_img))) {
                unlink(public_path('upload/brand/' . $old_img));
            }
            $image = $request->file('img');
            $filename = $brand->id . '.' . $image->getClientOriginalExtension();
            $location = public_path('upload/brand/' . $filename);
            Image::make($image)->save($location);
            $inputs['img'] = $filename;
        }

        $brand->update($inputs);

        return redirect()->route('admin.brands.index')->with('success', 'You have successfully updated the brand.');
    }

    public function destroy(Brand $brand)
    {
        $brand->delete();
        return back()->with('success', 'Brand successfully moved to trash.');
    }

    public function trashed()
    {
        return view('brand.recyclebin_brand', [
            'brands' => Brand::onlyTrashed()->paginate(10),
        ]);
    }

    public function restore($id)
    {
        Brand::withTrashed()->find($id)->restore();
        return back()->with('success', 'You have successfully restored the brand.');
    }

    public function forceDelete($id)
    {
        $brand = Brand::withTrashed()->find($id);

        $img = $brand->img;
        if ($img && file_exists(public_path('upload/brand/' . $img))) {
            unlink(public_path('upload/brand/' . $img));
        }

        $brand->forceDelete();
        return back()->with('success', 'You have permanently deleted the brand.');
    }
}