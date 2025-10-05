<?php

namespace App\Http\Controllers;

use App\Http\Requests\CuponStoreRequest;
use App\Http\Requests\CuponUpdateRequest;
use App\Models\Cupon;
use App\Services\CuponService;
use Illuminate\Http\Request;

class CuponController extends Controller
{
    protected $cuponService;

    public function __construct(CuponService $cuponService)
    {
        $this->middleware('auth');
        $this->cuponService = $cuponService;
    }

    public function index()
    {
        return view('backend.cupon.index', [
            'cupons' => $this->cuponService->getAllCupons(10),
        ]);
    }

    public function create()
    {
        return view('backend.cupon.create');
    }

    public function store(CuponStoreRequest $request)
    {
        $this->cuponService->createCupon($request->validated());
        return redirect()->route('admin.cupons.index')->with('success', 'You have successfully added a new cupon.');
    }

    public function edit(Cupon $cupon)
    {
        return view('backend.cupon.edit', [
            'item' => $cupon,
        ]);
    }

    public function update(CuponUpdateRequest $request, Cupon $cupon)
    {
        $this->cuponService->updateCupon($cupon->id, $request->validated());
        return redirect()->route('admin.cupons.index')->with('success', 'You have successfully updated the cupon.');
    }

    public function destroy(Cupon $cupon)
    {
        $this->cuponService->deleteCupon($cupon->id);
        return back()->with('success', 'Cupon successfully moved to trash.');
    }

    public function trashed()
    {
        return view('backend.cupon.trashed', [
            'cupons' => $this->cuponService->getTrashedCupons(10),
        ]);
    }

    public function restore($id)
    {
        $this->cuponService->restoreCupon($id);
        return back()->with('success', 'You have successfully restored the cupon.');
    }

    public function forceDelete($id)
    {
        $this->cuponService->forceDeleteCupon($id);
        return back()->with('success', 'You have permanently deleted the cupon.');
    }
}