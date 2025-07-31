<?php

namespace App\Services;

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

    public function createImage(array $data)
    {
        if (!isset($data['is_published'])) {
            $data['is_published'] = false;
        }
        return $this->repository->create($data);
    }

    public function updateImage(int $id, array $data)
    {
        return $this->repository->update($id, $data);
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
