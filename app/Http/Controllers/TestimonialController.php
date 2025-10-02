<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialStoreRequest;
use App\Http\Requests\TestimonialUpdateRequest;
use App\Models\Testimonial;
use Auth;
use Illuminate\Http\Request;
use Image;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('testimonial.index', [
            'testimonials' => Testimonial::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('testimonial.create');
    }

    public function store(TestimonialStoreRequest $request)
    {
        $inputs = $request->validated();
        $inputs['added_by'] = Auth::id();

        if ($request->hasFile('img')) {
            $image = $request->file('img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('upload/testimonial/' . $filename);
            Image::make($image)->save($location);
            $inputs['img'] = $filename;
        }

        Testimonial::create($inputs);

        return redirect()->route('admin.testimonials.index')->with('success', 'You have successfully added a new testimonial.');
    }

    public function edit(Testimonial $testimonial)
    {
        return view('testimonial.edit', [
            'item' => $testimonial,
        ]);
    }

    public function update(TestimonialUpdateRequest $request, Testimonial $testimonial)
    {
        $inputs = $request->validated();

        if ($request->hasFile('img')) {
            $old_img = $testimonial->img;
            if ($old_img && file_exists(public_path('upload/testimonial/' . $old_img))) {
                unlink(public_path('upload/testimonial/' . $old_img));
            }
            $image = $request->file('img');
            $filename = time() . '.' . $image->getClientOriginalExtension();
            $location = public_path('upload/testimonial/' . $filename);
            Image::make($image)->save($location);
            $inputs['img'] = $filename;
        }

        $testimonial->update($inputs);

        return redirect()->route('admin.testimonials.index')->with('success', 'You have successfully updated the testimonial.');
    }

    public function destroy(Testimonial $testimonial)
    {
        $testimonial->delete();
        return back()->with('success', 'Testimonial successfully moved to trash.');
    }

    public function trashed()
    {
        return view('testimonial.trashed', [
            'testimonials' => Testimonial::onlyTrashed()->paginate(10),
        ]);
    }

    public function restore($id)
    {
        Testimonial::withTrashed()->find($id)->restore();
        return back()->with('success', 'You have successfully restored the testimonial.');
    }

    public function forceDelete($id)
    {
        $testimonial = Testimonial::withTrashed()->find($id);

        $img = $testimonial->img;
        if ($img && file_exists(public_path('upload/testimonial/' . $img))) {
            unlink(public_path('upload/testimonial/' . $img));
        }

        $testimonial->forceDelete();
        return back()->with('success', 'You have permanently deleted the testimonial.');
    }
}