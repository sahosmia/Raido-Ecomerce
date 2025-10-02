<?php

namespace App\Services;

use App\Models\Subcategory;
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
        return $this->categoryRepository->getAll(9999); // Fetch all categories
    }

    public function getSubcategoriesByCategoryId(int $categoryId)
    {
        return Subcategory::where('category', $categoryId)->get();
    }

    public function createProduct(array $data, $mainImage = null, array $multipleImages = [])
    {
        $product = $this->productRepository->create($data);

        if ($mainImage) {
            $this->uploadMainImage($product, $mainImage);
        }

        if (!empty($multipleImages)) {
            $this->uploadMultipleImages($product, $multipleImages);
        }

        return $product;
    }

    public function updateProduct(int $id, array $data, $mainImage = null)
    {
        $product = $this->productRepository->getById($id);

        if ($mainImage) {
            $this->deleteFile('upload/product/' . $product->img);
            $data['img'] = $this->uploadMainImage($product, $mainImage, false);
        }

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
        $this->uploadMultipleImages($product, $images);
    }

    public function deleteProductPhoto(int $photoId)
    {
        $photo = $this->productRepository->findPhotoById($photoId);
        return $this->productRepository->deletePhoto($photo);
    }

    private function uploadMainImage($product, $image, bool $updateOnModel = true)
    {
        $filename = $product->id . '.' . $image->getClientOriginalExtension();
        $location = public_path('upload/product/' . $filename);
        Image::make($image)->save($location);

        if ($updateOnModel) {
            $product->update(['img' => $filename]);
        }

        return $filename;
    }

    private function uploadMultipleImages($product, array $images)
    {
        $photos = [];
        foreach ($images as $product_photo) {
            $img_extention = $product_photo->getClientOriginalExtension();
            $img_name = $product->id . "_product_photo_" . rand(1, 9999) . "." . $img_extention;
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

    private function deleteFile(string $path)
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}