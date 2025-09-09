<?php

namespace App\Services;

use Cloudinary\Cloudinary;
use Illuminate\Support\Facades\Log;

class CloudinaryService
{
    protected $cloudinary;

    public function __construct()
    {
        $this->cloudinary = new Cloudinary([
            'cloud' => [
                'cloud_name' => config('services.cloudinary.cloud_name'),
                'api_key'    => config('services.cloudinary.api_key'),
                'api_secret' => config('services.cloudinary.api_secret'),
            ]
        ]);
    }

    /**
     * Upload une image vers Cloudinary.
     *
     * @param string|mixed $imageData Chemin, base64 ou données binaires
     * @param string $folder Dossier Cloudinary
     * @param string|null $publicId Identifiant personnalisé
     * @return array
     */
    public function uploadImage($imageData, string $folder = 'ai-images', ?string $publicId = null): array
    {
        try {
            $options = ['folder' => $folder];

            if ($publicId) {
                $options['public_id'] = $publicId;
            }

            // Déterminer la bonne source pour Cloudinary
            if (is_string($imageData) && file_exists($imageData)) {
                $file = $imageData;
            } elseif (is_string($imageData) && str_starts_with($imageData, 'data:image')) {
                $file = $imageData;
            } else {
                $file = 'data:image/jpeg;base64,' . base64_encode($imageData);
            }

            $result = $this->cloudinary->uploadApi()->upload($file, $options);

            return [
                'success'   => true,
                'url'       => $result['secure_url'],
                'public_id' => $result['public_id'],
                'format'    => $result['format'],
                'bytes'     => $result['bytes']
            ];
        } catch (\Exception $e) {
            Log::error('Cloudinary upload failed: ' . $e->getMessage());

            return [
                'success' => false,
                'error'   => $e->getMessage()
            ];
        }
    }
}
