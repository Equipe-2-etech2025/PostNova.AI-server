<?php

namespace App\Services;

use App\Repositories\Interfaces\CampaignFeaturesRepositoryInterface;
use App\Services\Interfaces\CampaignFeaturesServiceInterface;

class CampaignFeaturesService implements CampaignFeaturesServiceInterface
{
    private CampaignFeaturesRepositoryInterface $repository;

    public function __construct(CampaignFeaturesRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAll()
    {
        return $this->repository->getAll();
    }

    public function getById(int $id)
    {
        return $this->repository->getById($id);
    }

    public function create(array $data)
    {
        return $this->repository->create($data);
    }

    public function update(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function delete(int $id)
    {
        return $this->repository->delete($id);
    }

    public function getByCriteria(array $criteria)
    {
        return $this->repository->getByCriteria($criteria);
    }
}
