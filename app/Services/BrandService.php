<?php

namespace App\Services;

use App\Repositories\Interfaces\BrandRepositoryInterface;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class BrandService
{
    protected $brandRepository;

    public function __construct(BrandRepositoryInterface $brandRepository)
    {
        $this->brandRepository = $brandRepository;
    }

    public function getAllBrands(int $perPage = 10)
    {
        return $this->brandRepository->getAll($perPage);
    }

    public function getTrashedBrands(int $perPage = 10)
    {
        return $this->brandRepository->getTrashed($perPage);
    }

    public function getBrandById(int $id)
    {
        return $this->brandRepository->getById($id);
    }

    public function createBrand(array $data, $image = null)
    {
        $brand = $this->brandRepository->create($data);

        if ($image) {
            $this->uploadImage($brand, $image);
        }

        return $brand;
    }

    public function updateBrand(int $id, array $data, $image = null)
    {
        $brand = $this->brandRepository->getById($id);

        if ($image) {
            $this->deleteImage($brand->img);
            $data['img'] = $this->uploadImage($brand, $image);
        }

        return $this->brandRepository->update($id, $data);
    }

    public function deleteBrand(int $id)
    {
        return $this->brandRepository->delete($id);
    }

    public function restoreBrand(int $id)
    {
        return $this->brandRepository->restore($id);
    }

    public function forceDeleteBrand(int $id)
    {
        $brand = $this->brandRepository->getTrashedById($id);
        $this->deleteImage($brand->img);
        return $this->brandRepository->forceDelete($id);
    }

    protected function uploadImage($brand, $image)
    {
        $filename = $brand->id . '.' . $image->getClientOriginalExtension();
        $location = public_path('upload/brand/' . $filename);
        Image::make($image)->save($location);
        $brand->update(['img' => $filename]);
        return $filename;
    }

    protected function deleteImage($filename)
    {
        if ($filename && File::exists(public_path('upload/brand/' . $filename))) {
            File::delete(public_path('upload/brand/' . $filename));
        }
    }
}