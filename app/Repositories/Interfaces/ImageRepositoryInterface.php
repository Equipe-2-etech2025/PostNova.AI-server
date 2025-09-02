<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Image\ImageDto;
use App\Models\Image;

interface ImageRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function findBy(array $criteria);

    public function create(ImageDto $imageDto): Image;

    public function update(int $id, ImageDto $imageDto): Image;

    public function delete(int $id);

    public function findByUserId(int $userId);
}
