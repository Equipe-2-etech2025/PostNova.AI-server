<?php

namespace App\Services;

use App\DTOs\CampaignFeatures\CampaignFeaturesDto;
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

    public function create(CampaignFeaturesDto $campaignFeaturesDto)
    {
        return $this->repository->create($campaignFeaturesDto);
    }

    public function update(int $id, CampaignFeaturesDto $campaignFeaturesDto)
    {
        return $this->repository->update($id, $campaignFeaturesDto);
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
