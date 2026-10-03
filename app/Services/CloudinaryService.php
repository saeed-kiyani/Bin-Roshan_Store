<?php

namespace App\Services;

use Cloudinary\Api\Upload\UploadApi;
use Cloudinary\Configuration\Configuration;
use Illuminate\Http\UploadedFile;
use InvalidArgumentException;

class CloudinaryService
{
    private UploadApi $uploadApi;

    public function __construct()
    {
        $cloudinaryUrl = config('filesystems.disks.cloudinary.url')
            ?: env('CLOUDINARY_URL');

        if (!$cloudinaryUrl) {
            throw new InvalidArgumentException(
                'CLOUDINARY_URL is not configured.'
            );
        }

        Configuration::instance($cloudinaryUrl);
        $this->uploadApi = new UploadApi();
    }

    public function uploadImage(UploadedFile $file, int $productId): array
    {
        $result = $this->uploadApi->upload(
            $file->getRealPath(),
            [
                'folder' => 'bin-roshan/products/' . $productId,
                'resource_type' => 'image',
                'use_filename' => false,
                'unique_filename' => true,
                'overwrite' => false,
            ]
        );

        return [
            'secure_url' => $result['secure_url'],
            'public_id' => $result['public_id'],
            'asset_id' => $result['asset_id'],
        ];
    }

    public function deleteImage(?string $assetId, ?string $publicId = null): void
    {
        // Cloudinary's upload destroy API deletes by public_id.
        // asset_id is stored for reference but is not used as the destroy identifier.
        $identifier = $publicId;

        if (!$identifier) {
            return;
        }

        $this->uploadApi->destroy($identifier, [
            'resource_type' => 'image',
            'type' => 'upload',
            'invalidate' => true,
        ]);
    }
}
