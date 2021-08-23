<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Brand;

class FrontendController extends Controller
{
    public function index()
    {
        return view('frontend.index', [
            'brands' => Brand::where('action', 1)->get(),
        ]);
    }
}
