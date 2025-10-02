<?php

namespace App\Http\Controllers;

use App\Http\Requests\BrandStoreRequest;
use App\Http\Requests\BrandUpdateRequest;
use App\Models\Brand;
use Auth;
use Illuminate\Http\Request;
use Image;
use Illuminate\Support\Facades\File;

class BrandController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('brand.index', [
            'brands' => Brand::with('user')->latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('brand.create');
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
        return view('brand.edit', [
            'item' => $brand,
        ]);
    }

    public function update(BrandUpdateRequest $request, Brand $brand)
    {
        $inputs = $request->validated();

        if ($request->hasFile('img')) {
            $old_img_path = public_path('upload/brand/' . $brand->img);
            if ($brand->img && File::exists($old_img_path)) {
                File::delete($old_img_path);
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
        return view('brand.trashed', [
            'brands' => Brand::onlyTrashed()->with('user')->latest()->paginate(10),
        ]);
    }

    public function restore($id)
    {
        Brand::withTrashed()->findOrFail($id)->restore();
        return back()->with('success', 'You have successfully restored the brand.');
    }

    public function forceDelete($id)
    {
        $brand = Brand::withTrashed()->findOrFail($id);

        $img_path = public_path('upload/brand/' . $brand->img);
        if ($brand->img && File::exists($img_path)) {
            File::delete($img_path);
        }

        $brand->forceDelete();
        return back()->with('success', 'You have permanently deleted the brand.');
    }
}