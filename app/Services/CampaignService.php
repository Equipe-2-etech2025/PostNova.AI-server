<?php

namespace App\Services;

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

    public function createCampaign(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateCampaign(int $campaignId, array $data)
    {
        return $this->repository->update($campaignId, $data);
    }

    public function deleteCampaign(int $id)
    {
        return $this->repository->delete($id);
    }

    public function getCampaignsByUser(int $userId)
    {
        return $this->repository->getByUser($userId);
    }

    public function getCampaignsByType(int $typeId)
    {
        return $this->repository->getByType($typeId);
    }

    public function getCampaignByCriteria(array $filters = [])
    {
        return $this->repository->getByCriteria($filters);
    }
}
