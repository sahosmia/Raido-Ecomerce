<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class SubcategoryController extends Controller
{
    public function index()
    {
        return view('subcategory.subcategory');
    }
}
