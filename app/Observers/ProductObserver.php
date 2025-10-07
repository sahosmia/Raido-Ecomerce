<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\ProductPhoto;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ProductObserver
{
    /**
     * Handle the Product "created" event.
     * We use the request() helper here to get the uploaded files.
     * This is a common practice, but it's worth noting that it couples the observer to the HTTP request.
     */
    public function created(Product $product): void
    {
        if (request()->hasFile('img')) {
            $this->uploadMainImage($product, request()->file('img'));
        }

        if (request()->hasFile('img_multiple')) {
            $this->uploadMultipleImages($product, request()->file('img_multiple'));
        }
    }

    /**
     * Handle the Product "updated" event.
     * We use the request() helper here to get the uploaded files.
     */
    public function updated(Product $product): void
    {
        if (request()->hasFile('img')) {
            if ($product->getOriginal('img')) {
                $this->deleteFile('upload/product/' . $product->getOriginal('img'));
            }
            $this->uploadMainImage($product, request()->file('img'));
        }
    }

    /**
     * Handle the Product "deleted" event.
     */
    public function deleted(Product $product): void
    {
        // Logic for soft delete if needed in the future
    }

    /**
     * Handle the Product "restored" event.
     */
    public function restored(Product $product): void
    {
        //
    }

    /**
     * Handle the Product "force deleted" event.
     */
    public function forceDeleted(Product $product): void
    {
        if ($product->getRawOriginal('img')) {
            $this->deleteFile('upload/product/' . $product->getRawOriginal('img'));
        }

        foreach ($product->photos as $photo) {
            $this->deleteFile('upload/product_photo/' . $photo->img);
            $photo->delete();
        }
    }

    private function uploadMainImage(Product $product, $image): void
    {
        $filename = $product->id . '.' . $image->getClientOriginalExtension();
        $location = public_path('upload/product/' . $filename);
        Image::make($image)->save($location);

        $product->withoutEvents(function () use ($product, $filename) {
            $product->update(['img' => $filename]);
        });
    }

    private function uploadMultipleImages(Product $product, array $images): void
    {
        foreach ($images as $product_photo) {
            $img_extension = $product_photo->getClientOriginalExtension();
            $img_name = $product->id . "_product_photo_" . rand(1, 9999) . "." . $img_extension;
            Image::make($product_photo)->save(public_path('upload/product_photo/' . $img_name));

            ProductPhoto::create([
                'img' => $img_name,
                'product' => $product->id,
            ]);
        }
    }

    private function deleteFile(string $path): void
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));
        }
    }
}