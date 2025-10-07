<?php

namespace App\Services;

use App\Repositories\Interfaces\ProductRepositoryInterface;
use App\Repositories\Interfaces\CategoryRepositoryInterface;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductService
{
    protected $productRepository;
    protected $categoryRepository;

    public function __construct(
        ProductRepositoryInterface $productRepository,
        CategoryRepositoryInterface $categoryRepository
    ) {
        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function getAllProducts(int $perPage = 10)
    {
        return $this->productRepository->getAll($perPage);
    }

    public function getTrashedProducts(int $perPage = 10)
    {
        return $this->productRepository->getTrashed($perPage);
    }

    public function getProductById(int $id)
    {
        return $this->productRepository->getById($id);
    }

    public function getAllCategories()
    {
        return $this->categoryRepository->getAll(9999);
    }

    public function createProduct(array $data)
    {
        return $this->productRepository->create($data);
    }

    public function updateProduct(int $id, array $data)
    {
        return $this->productRepository->update($id, $data);
    }

    public function deleteProduct(int $id)
    {
        return $this->productRepository->delete($id);
    }

    public function restoreProduct(int $id)
    {
        return $this->productRepository->restore($id);
    }

    public function forceDeleteProduct(int $id)
    {
        return $this->productRepository->forceDelete($id);
    }

    public function getPhotosForProduct(int $productId, int $perPage = 10)
    {
        return $this->productRepository->getPhotosByProductId($productId, $perPage);
    }

    public function addPhotosToProduct(int $productId, array $images)
    {
        $product = $this->productRepository->getById($productId);
        $photos = [];
        foreach ($images as $product_photo) {
            $img_extension = $product_photo->getClientOriginalExtension();
            $img_name = $product->id . "_product_photo_" . rand(1, 9999) . "." . $img_extension;
            Image::make($product_photo)->save(public_path('upload/product_photo/' . $img_name));

            $photos[] = [
                "img" => $img_name,
                "product" => $product->id,
                "created_at" => now(),
                "updated_at" => now(),
            ];
        }
        $this->productRepository->createPhotos($photos);
    }

    public function deleteProductPhoto(int $photoId)
    {
        $photo = $this->productRepository->findPhotoById($photoId);

        if ($photo) {
            $imagePath = public_path('upload/product_photo/' . $photo->getOriginal('img'));
            if (File::exists($imagePath)) {
                File::delete($imagePath);
            }
            return $this->productRepository->deletePhoto($photo);
        }
        return false;
    }
}