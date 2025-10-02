<?php

namespace App\Services;

use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class CategoryService
{
    protected $categoryRepository;

    public function __construct(CategoryRepositoryInterface $categoryRepository)
    {
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllCategories(int $perPage = 10)
    {
        return $this->categoryRepository->getAll($perPage);
    }

    public function getTrashedCategories(int $perPage = 10)
    {
        return $this->categoryRepository->getTrashed($perPage);
    }

    public function getCategoryById(int $id)
    {
        return $this->categoryRepository->getById($id);
    }

    public function createCategory(array $data, $image = null)
    {
        $category = $this->categoryRepository->create($data);

        if ($image) {
            $this->uploadImage($category, $image);
        }

        return $category;
    }

    public function updateCategory(int $id, array $data, $image = null)
    {
        $category = $this->categoryRepository->getById($id);

        if ($image) {
            $this->deleteImage($category->img);
            $data['img'] = $this->uploadImage($category, $image);
        }

        return $this->categoryRepository->update($id, $data);
    }

    public function deleteCategory(int $id)
    {
        return $this->categoryRepository->delete($id);
    }

    public function restoreCategory(int $id)
    {
        return $this->categoryRepository->restore($id);
    }

    public function forceDeleteCategory(int $id)
    {
        $category = $this->categoryRepository->getTrashedById($id);
        $this->deleteImage($category->img);
        return $this->categoryRepository->forceDelete($id);
    }

    protected function uploadImage($category, $image)
    {
        $filename = $category->id . '_category_' . time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('upload/category/' . $filename);
        Image::make($image)->save($location);
        $category->update(['img' => $filename]);
        return $filename;
    }

    protected function deleteImage($filename)
    {
        if ($filename && File::exists(public_path('upload/category/' . $filename))) {
            File::delete(public_path('upload/category/' . $filename));
        }
    }
}