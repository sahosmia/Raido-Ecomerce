<?php

namespace App\Repositories\Eloquent;

use App\Models\Category;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CategoryRepository implements CategoryRepositoryInterface
{
    public function getAll(int $perPage = 10)
    {
        return Category::latest()->paginate($perPage);
    }

    public function getActive(int $perPage = 10)
    {
        return Category::active()->latest()->paginate($perPage);
    }

    public function getTrashed(int $perPage = 10)
    {
        return Category::onlyTrashed()->latest()->paginate($perPage);
    }

    public function getById(int $id)
    {
        return Category::findOrFail($id);
    }

    public function getTrashedById(int $id)
    {
        return Category::withTrashed()->findOrFail($id);
    }

    public function create(array $data): Category
    {
        return Category::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $category = $this->getById($id);
        return $category->update($data);
    }

    public function delete(int $id): bool
    {
        $category = $this->getById($id);
        return $category->delete();
    }

    public function restore(int $id): bool
    {
        $category = $this->getTrashedById($id);
        return $category->restore();
    }

    public function forceDelete(int $id): bool
    {
        $category = $this->getTrashedById($id);
        if ($category->img && File::exists(public_path('upload/category/' . $category->img))) {
            File::delete(public_path('upload/category/' . $category->img));
        }
        return $category->forceDelete();
    }
}