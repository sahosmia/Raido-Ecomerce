<?php

namespace App\Http\Controllers;

use App\Http\Requests\TestimonialImageUpdateRequest;
use App\Http\Requests\TestimonialStoreRequest;
use App\Http\Requests\TestimonialUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Message;
use Auth;
use Carbon\Carbon;
use Image;

class TestimonialController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('checkauth');
    }

    // testimonial page view
    public function index()
    {
        return view('testimonial.testimonial', [
            'testimonials' => Testimonial::latest()->paginate(10),
            'testimonials_count' => Testimonial::count(),
            'messages' => Message::latest()->get(),
            'message_count' => Message::where('action', 1)->count(),
        ]);
    }

    // insert page view
    public function addtestimonial()
    {
        return view('testimonial.addtestimonial', [

            'messages' => Message::latest()->get(),
            'message_count' => Message::where('action', 1)->count(),
        ]);
    }

    // insert item
    public function addtestimonialinsert(TestimonialStoreRequest $req)
    {
        $name = $req->name;
        $img = $req->file('img');
        $title = $req->title;
        $des = $req->des;
        $added_by = Auth::id();
        $created_at = Carbon::now();

        $id = Testimonial::insertGetId([
            "name" => $name,
            "title" => $title,
            "des" => $des,
            "added_by" => $added_by,
            "created_at" => $created_at,
        ]);

        $img = $req->file('img');
        $img_extention = $img->getClientOriginalExtension();
        $img_name = $id . "testimonial" . rand(1, 9999) . "." . $img_extention;
        Image::make($img)->save(base_path('public/upload/testimonial/' . $img_name));

        Testimonial::find($id)->update([
            "img" => $img_name,
        ]);

        return redirect('testimonial')->with('success', 'You are success to add a new testimonial');
    }

    // recyclebin page view
    public function recyclebin()
    {
        return view('testimonial.recyclebin_testimonial', [
            'testimonials' => Testimonial::onlyTrashed()->paginate(10),
            'testimonials_count' => Testimonial::onlyTrashed()->count(),
            'messages' => Message::latest()->get(),
            'message_count' => Message::where('action', 1)->count(),
        ]);
    }

    // update
    public function update(TestimonialUpdateRequest $req)
    {
        Testimonial::find($req->id)->update([
            "name" => $req->name,
            "title" => $req->title,
            "des" => $req->des,
        ]);
        return back()->with('success', 'You are success to add a new testimonial');
    }
    // img update
    public function img_update(TestimonialImageUpdateRequest $req)
    {
        $id = $req->id;
        $old_img = Testimonial::find($id)->img;
        unlink('upload/testimonial/' . $old_img);

        $img = $req->file('img');
        $img_extention = $img->getClientOriginalExtension();
        $img_name = $id . rand(1, 9999) . "." . $img_extention;
        Image::make($img)->save(base_path('public/upload/testimonial/' . $img_name));

        Testimonial::find($id)->update([
            "img" => $img_name,
        ]);
        return back()->with('success', 'You are success to add a new testimonial');
    }


    // form_action
    public function form_action(Request $req)
    {

        $select_item = $req->check;
        switch ($req->action) {
            case "mark_p_delete":
                foreach ($select_item as $item) {
                    $img = Testimonial::withTrashed()->find($item)->img;
                    unlink('upload/testimonial/' . $img);
                    Testimonial::withTrashed()->find($item)->forceDelete();
                }
                return back()->with('error', 'You all selected item permanent delete');

                break;
            case "mark_s_delete":
                foreach ($select_item as $item) {
                    Testimonial::withTrashed()->find($item)->delete();
                }
                return back()->with('warning', 'You all selected item soft delete');

                break;
            case "mark_restore":
                foreach ($select_item as $item) {
                    Testimonial::withTrashed()->find($item)->restore();
                }
                return back()->with('success', 'You all selected item Restore');

                break;
        }
    }

    // update_testimonial page view
    public function update_testimonial($id)
    {
        return view('testimonial.update_testimonial', [
            'item' => Testimonial::find($id),
            'messages' => Message::latest()->get(),
            'message_count' => Message::where('action', 1)->count(),
        ]);
    }

    // soft_delete single
    public function soft_delete($id)
    {
        Testimonial::withTrashed()->find($id)->delete();
        return back()->with('error', 'You are soft all delete your testimonial');
    }

    // p_delete single
    public function p_delete($id)
    {
        $img = Testimonial::withTrashed()->find($id)->img;
        unlink('upload/testimonial/' . $img);
        Testimonial::withTrashed()->find($id)->forceDelete();
        return back()->with('error', 'You are soft all delete your testimonial');
    }

    // restore single
    public function restore($id)
    {
        Testimonial::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'You are success to restore your testimonial');
    }

    // action active deactive
    public function action($id)
    {
        if (Testimonial::find($id)->action == 1) {
            Testimonial::find($id)->update([
                "action" => 2,
            ]);
            return back()->with('warning', 'You are success to deactive your testimonial');
        } else {
            Testimonial::find($id)->update([
                "action" => 1,
            ]);
            return back()->with('success', 'You are success to active your testimonial');
        }
    }

    // soft_delete all
    public function soft_delete_all()
    {
        Testimonial::whereNotNull('id')->delete();
        // Category::truncate();
        return back()->with('error', 'You are soft all delete your testimonial');
    }

    // p_delete all
    public function p_delete_all()
    {
        $items = Testimonial::withTrashed()->get();
        foreach ($items as $item) {
            unlink('upload/testimonial/' . $item->img);
        }
        Testimonial::truncate();
        return back()->with('error', 'You are permanent all delete your testimonial');
    }

    // restore all
    public function restore_all()
    {
        Testimonial::onlyTrashed()->restore();
        return back()->with('success', 'You are success to restore your testimonial');
    }
}