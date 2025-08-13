<?php

namespace App\Services;

use App\DTOs\Campaign\CampaignDto;
use App\Models\Campaign;
use App\Repositories\CampaignRepository;
use App\Services\Interfaces\CampaignServiceInterface;

class CampaignService implements CampaignServiceInterface
{
    protected CampaignRepository $repository;

    public function __construct(CampaignRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllCampaigns(array $filters = [])
    {
        return $this->repository->all();
    }

    public function getCampaignById(int $id)
    {
        return $this->repository->find($id);
    }

    public function createCampaign(CampaignDto $campaignDto): Campaign
    {
        return $this->repository->create($campaignDto);
    }

    public function updateCampaign(int $campaignId, CampaignDto $campaignDto): Campaign
    {
        return $this->repository->update($campaignId, $campaignDto);
    }

    public function deleteCampaign(int $id)
    {
        return $this->repository->delete($id);
    }

    public function getCampaignsByUserId(int $userId)
    {
        return $this->repository->findByUserId($userId);
    }

    public function getCampaignsByType(int $typeId)
    {
        return $this->repository->findByTypeCampaignId($typeId);
    }

    public function getCampaignByCriteria(array $criteria = [])
    {
        return $this->repository->findByCriteria($criteria);
    }
}
