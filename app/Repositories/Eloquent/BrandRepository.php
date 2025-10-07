<?php

namespace App\Repositories\Eloquent;

use App\Models\Brand;
use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Support\Facades\File;

class BrandRepository implements BrandRepositoryInterface
{
    public function getAll(int $perPage = 10)
    {
        return Brand::latest()->paginate($perPage);
    }

    public function getActive(int $perPage = 10)
    {
        return Brand::active()->latest()->paginate($perPage);
    }

    public function getTrashed(int $perPage = 10)
    {
        return Brand::onlyTrashed()->latest()->paginate($perPage);
    }

    public function getById(int $id)
    {
        return Brand::findOrFail($id);
    }

    public function getTrashedById(int $id)
    {
        return Brand::withTrashed()->findOrFail($id);
    }

    public function create(array $data): Brand
    {
        return Brand::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $brand = $this->getById($id);
        return $brand->update($data);
    }

    public function delete(int $id): bool
    {
        $brand = $this->getById($id);
        return $brand->delete();
    }

    public function restore(int $id): bool
    {
        $brand = $this->getTrashedById($id);
        return $brand->restore();
    }

    public function forceDelete(int $id): bool
    {
        $brand = $this->getTrashedById($id);
        if ($brand->img && File::exists(public_path('upload/brand/' . $brand->img))) {
            File::delete(public_path('upload/brand/' . $brand->img));
        }
        return $brand->forceDelete();
    }
}