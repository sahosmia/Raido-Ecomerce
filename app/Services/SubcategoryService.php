<?php

namespace App\Services;

use App\Repositories\Interfaces\SubcategoryRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;

class SubcategoryService
{
    protected $subcategoryRepository;
    protected $categoryRepository;

    public function __construct(SubcategoryRepositoryInterface $subcategoryRepository, CategoryRepositoryInterface $categoryRepository)
    {
        $this->subcategoryRepository = $subcategoryRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllSubcategories(int $perPage = 10)
    {
        return $this->subcategoryRepository->getAll($perPage);
    }

    public function getTrashedSubcategories(int $perPage = 10)
    {
        return $this->subcategoryRepository->getTrashed($perPage);
    }

    public function getAllCategories()
    {
        // This seems to fetch all categories without pagination, which is what the original controller did.
        // If performance becomes an issue, this could be revisited.
        return $this->categoryRepository->getAll(9999); // A large number to get all
    }

    public function createSubcategory(array $data)
    {
        // The 'category' key is named 'category_id' in the request, but the db column is 'category'
        $data['category'] = $data['category_id'];
        return $this->subcategoryRepository->create($data);
    }

    public function updateSubcategory(int $id, array $data)
    {
        $data['category'] = $data['category_id'];
        return $this->subcategoryRepository->update($id, $data);
    }

    public function deleteSubcategory(int $id)
    {
        return $this->subcategoryRepository->delete($id);
    }

    public function restoreSubcategory(int $id)
    {
        return $this->subcategoryRepository->restore($id);
    }

    public function forceDeleteSubcategory(int $id)
    {
        return $this->subcategoryRepository->forceDelete($id);
    }
}