<?php

namespace App\Repositories\Eloquent;

use App\Models\Cupon;
use App\Repositories\Interfaces\CuponRepositoryInterface;

class CuponRepository implements CuponRepositoryInterface
{
    public function getAll(int $perPage = 10)
    {
        return Cupon::latest()->paginate($perPage);
    }

    public function getTrashed(int $perPage = 10)
    {
        return Cupon::onlyTrashed()->paginate($perPage);
    }

    public function getById(int $id)
    {
        return Cupon::findOrFail($id);
    }

    public function getTrashedById(int $id)
    {
        return Cupon::withTrashed()->findOrFail($id);
    }

    public function create(array $data): Cupon
    {
        return Cupon::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $cupon = $this->getById($id);
        return $cupon->update($data);
    }

    public function delete(int $id): bool
    {
        $cupon = $this->getById($id);
        return $cupon->delete();
    }

    public function restore(int $id): bool
    {
        $cupon = $this->getTrashedById($id);
        return $cupon->restore();
    }

    public function forceDelete(int $id): bool
    {
        $cupon = $this->getTrashedById($id);
        return $cupon->forceDelete();
    }
}