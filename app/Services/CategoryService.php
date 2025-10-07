<?php

namespace App\Services;

use App\Models\Subcategory;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\Cache;

class CategoryService
{
    protected $categoryRepository;
    protected $fileService;

    public function __construct(CategoryRepositoryInterface $categoryRepository, FileService $fileService)
    {
        $this->categoryRepository = $categoryRepository;
        $this->fileService = $fileService;
    }

    public function getAllCategories(int $perPage = 10)
    {
        $page = request('page', 1);
        return Cache::tags(['categories'])->remember("categories.page.{$page}", now()->addMinutes(60), function () use ($perPage) {
            return $this->categoryRepository->getAll($perPage);
        });
    }

    public function getTrashedCategories(int $perPage = 10)
    {
        $page = request('page', 1);
        return Cache::tags(['categories'])->remember("categories.trashed.page.{$page}", now()->addMinutes(60), function () use ($perPage) {
            return $this->categoryRepository->getTrashed($perPage);
        });
    }

    public function getCategoryById(int $id)
    {
        return Cache::tags(['categories'])->remember("category.{$id}", now()->addMinutes(60), function () use ($id) {
            return $this->categoryRepository->getById($id);
        });
    }

    public function getSubcategoriesByCategoryId(int $categoryId)
    {
        return Subcategory::where('category', $categoryId)->get();
    }

    public function createCategory(array $data, $image = null)
    {
        $category = $this->categoryRepository->create($data);

        if ($image) {
            $this->fileService->uploadImage($category, $image, 'category');
        }

        $this->clearCategoriesCache();
        return $category;
    }

    public function updateCategory(\App\Models\Category $category, array $data, $image = null)
    {
        if ($image) {
            $this->fileService->updateImage($category, $image, $category->img, 'category');
        }

        $result = $this->categoryRepository->update($category->id, $data);
        $this->clearCategoriesCache();
        return $result;
    }

    public function deleteCategory(\App\Models\Category $category)
    {
        $result = $this->categoryRepository->delete($category->id);
        $this->clearCategoriesCache();
        return $result;
    }

    public function restoreCategory(\App\Models\Category $category)
    {
        $result = $this->categoryRepository->restore($category->id);
        $this->clearCategoriesCache();
        return $result;
    }

    public function forceDeleteCategory(\App\Models\Category $category)
    {
        $this->fileService->deleteImage($category->img, 'category');
        $result = $this->categoryRepository->forceDelete($category->id);
        $this->clearCategoriesCache();
        return $result;
    }

    protected function clearCategoriesCache()
    {
        Cache::tags(['categories'])->flush();
    }
}