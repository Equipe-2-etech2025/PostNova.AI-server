<?php

namespace App\Services\Interfaces;

use App\DTOs\Image\ImageDto;

interface ImageServiceInterface
{
    public function getAllImages(array $filters = []);

    public function getImageById(int $id);

    public function getImageByCriteria(array $criteria);

    public function updateImage(int $id, ImageDto $imageDto);

    public function createImage(ImageDto $imageDto);

    public function deleteImage(int $id);

    public function getImageByUserId(int $userId);
}
