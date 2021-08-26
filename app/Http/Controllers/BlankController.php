<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Carbon\Carbon;

class BlankController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('checkauth');
    }
    public function index()
    {
        return view('blank.demo', [
            'categories' => Category::latest()->paginate(10),
            'categories_count' => Category::count(),

        ]);
    }
    public function blank_form()
    {
        return view('blank.form', [
            'categories' => Category::latest()->paginate(10),
        ]);
    }
    public function blank_form_submit(Request $req)
    {
        $name = $req->name;
        $added_by = Auth::id();
        $created_at = Carbon::now();

        print_r($req->all());


        $req->validate([
            'name' => 'required|unique:categories,name|string|min:3|max:40',
            // 'email' => 'required|email|unique:users,email',
            // 'img' => 'required|file|image|mimes:jpeg,jpg,png',
            // 'password' => 'required|confirmed|min:6',
            // 'des' => 'required|string|min:120|max:2000',
            // 'select_name' => 'required',
            // 'date' => 'required|date|after:tomorrow',
            // 'discount' => 'required|numeric|min:5|max:50',
            'url' => 'required|url',

        ]);

        die();
        $id = Category::insertGetId([
            "name" => $name,
            "added_by" => $added_by,
            "created_at" => $created_at,
        ]);

        $img = $req->file('img');
        $img_extention = $img->getClientOriginalExtension();
        $img_name = $id . rand(1, 9999) . "." . $img_extention;
        Image::make($img)->save(base_path('public/upload/category/' . $img_name));

        Category::find($id)->update([
            "img" => $img_name,
        ]);



        // return view('blank.form');
    }
}
