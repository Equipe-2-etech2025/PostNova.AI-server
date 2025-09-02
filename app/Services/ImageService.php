<?php

namespace App\Services;

use App\DTOs\Image\ImageDto;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Services\Interfaces\ImageServiceInterface;

class ImageService implements ImageServiceInterface
{
    protected $repository;

    public function __construct(ImageRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllImages(array $filters = [])
    {
        return $this->repository->all();
    }

    public function getImageById(int $id)
    {
        return $this->repository->find($id);
    }

    public function getImageByCriteria(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function createImage(ImageDto $imageDto)
    {
        return $this->repository->create($imageDto);
    }

    public function updateImage(int $id, ImageDto $imageDto)
    {
        return $this->repository->update($id, $imageDto);
    }

    public function deleteImage(int $id)
    {
        return $this->repository->delete($id);
    }

    public function getImageByUserId(int $userId)
    {
        return $this->repository->findByUserId($userId);
    }
}
