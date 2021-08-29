<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Testimonial;
use App\Models\Message;
use Auth;
use Carbon\Carbon;
use Image;

class testimonialController extends Controller
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
            'testimonials' => testimonial::latest()->paginate(10),
            'testimonials_count' => testimonial::count(),
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
    public function addtestimonialinsert(Request $req)
    {
        $name = $req->name;
        $img = $req->file('img');
        $title = $req->title;
        $des = $req->des;
        $added_by = Auth::id();
        $created_at = Carbon::now();

        $req->validate([
            'name' => 'required|unique:testimonials,name',
            'title' => 'required',
            'des' => 'required',
            'img' => 'required',
        ]);



        $id = testimonial::insertGetId([
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

        testimonial::find($id)->update([
            "img" => $img_name,
        ]);

        return redirect('testimonial')->with('success', 'You are success to add a new testimonial');
    }

    // recyclebin page view
    public function recyclebin()
    {
        return view('testimonial.recyclebin_testimonial', [
            'testimonials' => testimonial::onlyTrashed()->paginate(10),
            'testimonials_count' => testimonial::onlyTrashed()->count(),
            'messages' => Message::latest()->get(),
            'message_count' => Message::where('action', 1)->count(),
        ]);
    }

    // update 
    public function update(Request $req)
    {
        $req->validate([
            'name' => 'required',
            'title' => 'required',
            'des' => 'required',
        ]);

        testimonial::find($req->id)->update([
            "name" => $req->name,
            "title" => $req->title,
            "des" => $req->des,
        ]);
        return back()->with('success', 'You are success to add a new testimonial');
    }
    // img update
    public function img_update(Request $req)
    {

        $req->validate([
            'img' => 'required',
        ]);

        $id = $req->id;
        $old_img = testimonial::find($id)->img;
        unlink('upload/testimonial/' . $old_img);

        $img = $req->file('img');
        $img_extention = $img->getClientOriginalExtension();
        $img_name = $id . rand(1, 9999) . "." . $img_extention;
        Image::make($img)->save(base_path('public/upload/testimonial/' . $img_name));

        testimonial::find($id)->update([
            "img" => $img_name,
        ]);

        testimonial::find($id)->update([
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
                    $img = testimonial::withTrashed()->find($item)->img;
                    unlink('upload/testimonial/' . $img);
                    testimonial::withTrashed()->find($item)->forceDelete();
                }
                return back()->with('error', 'You all selected item permanent delete');

                break;
            case "mark_s_delete":
                foreach ($select_item as $item) {
                    testimonial::withTrashed()->find($item)->delete();
                }
                return back()->with('warning', 'You all selected item soft delete');

                break;
            case "mark_restore":
                foreach ($select_item as $item) {
                    testimonial::withTrashed()->find($item)->restore();
                }
                return back()->with('success', 'You all selected item Restore');

                break;
        }
    }

    // update_testimonial page view
    public function update_testimonial($id)
    {
        return view('testimonial.update_testimonial', [
            'item' => testimonial::find($id),
            'messages' => Message::latest()->get(),
            'message_count' => Message::where('action', 1)->count(),
        ]);
    }

    // soft_delete single
    public function soft_delete($id)
    {
        testimonial::withTrashed()->find($id)->delete();
        return back()->with('error', 'You are soft all delete your testimonial');
    }

    // p_delete single
    public function p_delete($id)
    {
        $img = testimonial::withTrashed()->find($id)->img;
        unlink('upload/testimonial/' . $img);
        testimonial::withTrashed()->find($id)->forceDelete();
        return back()->with('error', 'You are soft all delete your testimonial');
    }

    // restore single
    public function restore($id)
    {
        testimonial::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'You are success to restore your testimonial');
    }

    // action active deactive
    public function action($id)
    {
        if (testimonial::find($id)->action == 1) {
            testimonial::find($id)->update([
                "action" => 2,
            ]);
            return back()->with('warning', 'You are success to deactive your testimonial');
        } else {
            testimonial::find($id)->update([
                "action" => 1,
            ]);
            return back()->with('success', 'You are success to active your testimonial');
        }
    }

    // soft_delete all
    public function soft_delete_all()
    {
        testimonial::whereNotNull('id')->delete();
        // Category::truncate();
        return back()->with('error', 'You are soft all delete your testimonial');
    }

    // p_delete all
    public function p_delete_all()
    {
        $items = testimonial::withTrashed()->get();
        foreach ($items as $item) {
            unlink('upload/testimonial/' . $item->img);
        }
        testimonial::truncate();
        return back()->with('error', 'You are permanent all delete your testimonial');
    }

    // restore all
    public function restore_all()
    {
        testimonial::onlyTrashed()->restore();
        return back()->with('success', 'You are success to restore your testimonial');
    }
}
