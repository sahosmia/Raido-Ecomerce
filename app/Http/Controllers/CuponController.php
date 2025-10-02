<?php

namespace App\Http\Controllers;

use App\Http\Requests\CuponStoreRequest;
use App\Http\Requests\CuponUpdateRequest;
use App\Models\Cupon;
use Auth;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('cupon.cupon', [
            'cupons' => Cupon::latest()->paginate(10),
        ]);
    }

    public function create()
    {
        return view('cupon.addcupon');
    }

    public function store(CuponStoreRequest $request)
    {
        Cupon::create([
            'name' => $request->name,
            'code' => $request->code,
            'discount' => $request->discount,
            'end_cupon' => $request->date,
            'added_by' => Auth::id(),
        ]);

        return redirect()->route('admin.cupons.index')->with('success', 'You have successfully added a new cupon.');
    }

    public function edit(Cupon $cupon)
    {
        return view('cupon.update_cupon', [
            'item' => $cupon,
        ]);
    }

    public function update(CuponUpdateRequest $request, Cupon $cupon)
    {
        $cupon->update([
            'name' => $request->name,
            'code' => $request->code,
            'discount' => $request->discount,
            'end_cupon' => $request->date,
        ]);

        return redirect()->route('admin.cupons.index')->with('success', 'You have successfully updated the cupon.');
    }

    public function destroy(Cupon $cupon)
    {
        $cupon->delete();
        return back()->with('success', 'Cupon successfully moved to trash.');
    }

    public function trashed()
    {
        return view('cupon.recyclebin_cupon', [
            'cupons' => Cupon::onlyTrashed()->paginate(10),
        ]);
    }

    public function restore($id)
    {
        Cupon::withTrashed()->find($id)->restore();
        return back()->with('success', 'You have successfully restored the cupon.');
    }

    public function forceDelete($id)
    {
        Cupon::withTrashed()->find($id)->forceDelete();
        return back()->with('success', 'You have permanently deleted the cupon.');
    }
}