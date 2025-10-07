<?php

namespace App\Repositories\Eloquent;

use App\Models\Product;
use App\Models\ProductPhoto;
use App\Repositories\Interfaces\ProductRepositoryInterface;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\File;

class ProductRepository implements ProductRepositoryInterface
{
    public function getAll(int $perPage = 10)
    {
        return Product::with('category_info', 'subcategory_info', 'user', 'photos')->latest()->paginate($perPage);
    }

    public function getTrashed(int $perPage = 10)
    {
        return Product::onlyTrashed()->with('category_info', 'subcategory_info', 'user')->latest()->paginate($perPage);
    }

    public function getById(int $id)
    {
        return Product::with('photos')->findOrFail($id);
    }

    public function getTrashedById(int $id)
    {
        return Product::onlyTrashed()->with('photos')->findOrFail($id);
    }

    public function create(array $data): Product
    {
        return Product::create($data);
    }

    public function update(int $id, array $data): bool
    {
        $product = $this->getById($id);
        return $product->update($data);
    }

    public function delete(int $id): bool
    {
        $product = $this->getById($id);
        return $product->delete();
    }

    public function restore(int $id): bool
    {
        $product = $this->getTrashedById($id);
        return $product->restore();
    }

    public function forceDelete(int $id): bool
    {
        $product = $this->getTrashedById($id);

        foreach ($product->photos as $photo) {
            $this->deletePhotoFile($photo->img);
        }
        $product->photos()->delete();
        $this->deleteProductImageFile($product->img);

        return $product->forceDelete();
    }

    public function getPhotosByProductId(int $productId, int $perPage = 10)
    {
        return ProductPhoto::where('product', $productId)->paginate($perPage);
    }

    public function createPhotos(array $photos): bool
    {
        return ProductPhoto::insert($photos);
    }

    public function findPhotoById(int $photoId): ProductPhoto
    {
        return ProductPhoto::findOrFail($photoId);
    }

    public function deletePhoto(ProductPhoto $photo): bool
    {
        $this->deletePhotoFile($photo->img);
        return $photo->delete();
    }

    private function deleteProductImageFile(?string $filename): void
    {
        if ($filename && File::exists(public_path('upload/product/' . $filename))) {
            File::delete(public_path('upload/product/' . $filename));
        }
    }

    private function deletePhotoFile(?string $filename): void
    {
        if ($filename && File::exists(public_path('upload/product_photo/' . $filename))) {
            File::delete(public_path('upload/product_photo/' . $filename));
        }
    }
}