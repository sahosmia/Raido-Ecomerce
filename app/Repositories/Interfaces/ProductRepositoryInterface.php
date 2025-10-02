<?php

namespace App\Repositories\Interfaces;

use App\Models\Product;
use App\Models\Product_photo;
use Illuminate\Database\Eloquent\Collection;

interface ProductRepositoryInterface
{
    public function getAll(int $perPage);
    public function getTrashed(int $perPage);
    public function getById(int $id);
    public function getTrashedById(int $id);
    public function create(array $data): Product;
    public function update(int $id, array $data): bool;
    public function delete(int $id): bool;
    public function restore(int $id): bool;
    public function forceDelete(int $id): bool;

    // Product Photos
    public function getPhotosByProductId(int $productId, int $perPage);
    public function createPhotos(array $photos): bool;
    public function findPhotoById(int $photoId): Product_photo;
    public function deletePhoto(Product_photo $photo): bool;
}