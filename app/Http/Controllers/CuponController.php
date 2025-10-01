<?php

namespace App\Http\Controllers;

use App\Http\Requests\CuponStoreRequest;
use App\Http\Requests\CuponUpdateRequest;
use Illuminate\Http\Request;
use App\Models\Cupon;
use Auth;
use Carbon\Carbon;



class CuponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        // $this->middleware('checkauth');
    }

    // cupon page view
    public function index()
    {
        return view('cupon.cupon', [
            'cupons' => Cupon::latest()->paginate(10),
            'cupons_count' => Cupon::count(),
        ]);
    }

    // insert page view
    public function addcupon()
    {
        return view('cupon.addcupon');
    }

    // insert item
    public function addcuponinsert(CuponStoreRequest $req)
    {

        $name = $req->name;
        $code = $req->code;
        $discount = $req->discount;
        $end_cupon  = $req->date;
        $created_at = Carbon::now();
        $added_by = Auth::id();

        Cupon::insert([
            "name" => $name,
            "code" => $code,
            "end_cupon" => $end_cupon,
            "discount" => $discount,
            "added_by" => $added_by,
            "created_at" => $created_at,
        ]);

        return redirect('cupon')->with('success', 'You are success to add a new cupon');
    }

    // recyclebin page view
    public function recyclebin()
    {
        return view('cupon.recyclebin_cupon', [
            'cupons' => cupon::onlyTrashed()->paginate(10),
            'cupons_count' => cupon::onlyTrashed()->count(),
        ]);
    }

    // update view
    public function update(CuponUpdateRequest $req)
    {
        $name = $req->name;
        $code = $req->code;
        $discount = $req->discount;
        $end_cupon  = $req->date;
        $id = $req->id;

        Cupon::find($id)->update([
            "name" => $name,
            "code" => $code,
            "end_cupon" => $end_cupon,
            "discount" => $discount,
        ]);
        return back()->with('success', 'You are success to add a new cupon');
    }



    // form_action
    public function form_action(Request $req)
    {

        $select_item = $req->check;
        switch ($req->action) {
            case "mark_p_delete":
                foreach ($select_item as $item) {
                    Cupon::withTrashed()->find($item)->forceDelete();
                }
                return back()->with('error', 'You all selected item permanent delete');

                break;
            case "mark_s_delete":
                foreach ($select_item as $item) {
                    Cupon::withTrashed()->find($item)->delete();
                }
                return back()->with('warning', 'You all selected item soft delete');

                break;
            case "mark_restore":
                foreach ($select_item as $item) {
                    Cupon::withTrashed()->find($item)->restore();
                }
                return back()->with('success', 'You all selected item Restore');

                break;
        }
    }




    /* view id page
    .
    .
    .
    .
    .
    .
    .view id page
    .
    .
    .
    .
    view id page
    */

    // update_cupon page view
    public function update_cupon($id)
    {
        return view('cupon.update_cupon', [
            'item' => Cupon::find($id),
        ]);
    }

    // soft_delete single
    public function soft_delete($id)
    {
        Cupon::withTrashed()->find($id)->delete();
        return back()->with('error', 'You are soft all delete your cupon');
    }

    // p_delete single
    public function p_delete($id)
    {
        Cupon::withTrashed()->find($id)->forceDelete();
        return back()->with('error', 'You are soft all delete your cupon');
    }

    // restore single
    public function restore($id)
    {
        Cupon::onlyTrashed()->find($id)->restore();
        return back()->with('success', 'You are success to restore your cupon');
    }

    // action active deactive
    public function action($id)
    {
        if (Cupon::find($id)->action == 1) {
            Cupon::find($id)->update([
                "action" => 2,
            ]);
            return back()->with('warning', 'You are success to deactive your cupon');
        } else {
            Cupon::find($id)->update([
                "action" => 1,
            ]);
            return back()->with('success', 'You are success to active your cupon');
        }
    }

    // soft_delete all
    public function soft_delete_all()
    {
        Cupon::whereNotNull('id')->delete();
        // Category::truncate();
        return back()->with('error', 'You are soft all delete your cupon');
    }

    // p_delete all
    public function p_delete_all()
    {
        Cupon::truncate();
        return back()->with('error', 'You are permanent all delete your cupon');
    }

    // restore all
    public function restore_all()
    {
        Cupon::onlyTrashed()->restore();
        return back()->with('success', 'You are success to restore your cupon');
    }
}