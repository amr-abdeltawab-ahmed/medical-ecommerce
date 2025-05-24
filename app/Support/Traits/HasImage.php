<?php

namespace App\Support\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

trait HasImage
{
    public function storeImage(UploadedFile $image, string $path = 'images'): string
    {
        return $image->store($path, 'public');
    }

    public function updateImage(?UploadedFile $newImage, ?string $oldImage = null, string $path = 'images'): ?string
    {
        if ($oldImage) {
            $this->deleteImage($oldImage);
        }

        return $newImage ? $this->storeImage($newImage, $path) : null;
    }

    public function deleteImage(?string $image): bool
    {
        if (!$image) {
            return false;
        }

        return Storage::disk('public')->delete($image);
    }
} 