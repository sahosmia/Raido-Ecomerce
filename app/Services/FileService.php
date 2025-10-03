<?php

namespace App\Services;

use Illuminate\Support\Facades\File;
use Illuminate\Http\UploadedFile;
use Intervention\Image\Facades\Image;

class FileService
{
    /**
     * Upload an image and update the model.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Illuminate\Http\UploadedFile $image
     * @param string $directory
     * @param string $field
     * @return string
     */
    public function uploadImage($model, UploadedFile $image, string $directory, string $field = 'img'): string
    {
        $filename = $model->id . '_' . str_replace(' ', '_', $model->name) . '_' . time() . '.' . $image->getClientOriginalExtension();
        $location = public_path('upload/' . $directory . '/' . $filename);
        Image::make($image)->save($location);

        $model->update([$field => $filename]);

        return $filename;
    }

    /**
     * Delete an image from storage.
     *
     * @param string|null $filename
     * @param string $directory
     * @return void
     */
    public function deleteImage(?string $filename, string $directory): void
    {
        if ($filename && File::exists(public_path('upload/' . $directory . '/' . $filename))) {
            File::delete(public_path('upload/' . $directory . '/' . $filename));
        }
    }

    /**
     * Update an image by deleting the old one and uploading the new one.
     *
     * @param \Illuminate\Database\Eloquent\Model $model
     * @param \Illuminate\Http\UploadedFile $newImage
     * @param string|null $oldImageFilename
     * @param string $directory
     * @param string $field
     * @return string
     */
    public function updateImage($model, UploadedFile $newImage, ?string $oldImageFilename, string $directory, string $field = 'img'): string
    {
        $this->deleteImage($oldImageFilename, $directory);
        return $this->uploadImage($model, $newImage, $directory, $field);
    }
}