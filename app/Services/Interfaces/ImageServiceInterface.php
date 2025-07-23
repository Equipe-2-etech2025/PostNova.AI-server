<?php

namespace App\Services\Interfaces;

interface ImageServiceInterface
{
    public function getAllImages(array $filters = []);
    public function getImageById(int $id);
    public function getImageByCriteria(array $criteria);
    public function updateImage(int $id, array $data);
    public function createImage(array $data);
    public function deleteImage(int $id);
}
