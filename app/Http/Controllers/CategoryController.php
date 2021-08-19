<?php

namespace App\Http\Controllers;

use App\Models\Category;


use Illuminate\Http\Request;
use Auth;
use Carbon\Carbon;
use Image;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('checkauth');
    }
    public function index()
    {
        return view('category.category', [
            'categories' => Category::latest()->paginate(10),
            'categories_count' => Category::count(),

        ]);

        // print_r(Category::all());
        // foreach (Category::all() as $data) {
        //     echo $data;
        //     echo "<br>";
        // }
    }

    public function addcategory()
    {
        return view('category.addcategory');
    }
    public function addcategoryinsert(Request $req)
    {
        // echo rand(1, 9999);
        // die();
        $req->validate([
            'name' => 'required|unique:categories,name',
            'img' => 'required',
        ]);

        $name = $req->name;
        $added_by = Auth::id();
        $created_at = Carbon::now();

        $id = Category::insertGetId([
            "name" => $name,
            "added_by" => $added_by,
            "created_at" => $created_at,
        ]);

        $img = $req->file('img');
        $img_extention = $img->getClientOriginalExtension();
        $img_name = $id . rand(1, 9999) . "." . $img_extention;
        Image::make($img)->save(base_path('public/upload/category/' . $img_name));

        echo 'sahos';
        Category::find($id)->update([
            "img" => $img_name,
        ]);
    }
}
