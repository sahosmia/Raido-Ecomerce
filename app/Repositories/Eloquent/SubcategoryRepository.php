<?php

namespace App\Repositories\Eloquent;

use App\Models\Subcategory;
use App\Repositories\Interfaces\SubcategoryRepositoryInterface;

class SubcategoryRepository implements SubcategoryRepositoryInterface
{
    public function getAll(int $perPage = 10)
    {
        return Subcategory::with('category_info', 'user')->latest()->paginate($perPage);
    }

    public function getTrashed(int $perPage = 10)
    {
        return Subcategory::onlyTrashed()->with('category_info', 'user')->latest()->paginate($perPage);
    }

    public function getById(int $id)
    {
        return Subcategory::findOrFail($id);
    }

    public function getTrashedById(int $id)
    {
        return Subcategory::withTrashed()->findOrFail($id);
    }

    public function create(array $data): Subcategory
    {
        return Subcategory::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $subcategory = $this->getById($id);
        return $subcategory->update($data);
    }

    public function delete(int $id): bool
    {
        $subcategory = $this->getById($id);
        return $subcategory->delete();
    }

    public function restore(int $id): bool
    {
        $subcategory = $this->getTrashedById($id);
        return $subcategory->restore();
    }

    public function forceDelete(int $id): bool
    {
        $subcategory = $this->getTrashedById($id);
        return $subcategory->forceDelete();
    }
}