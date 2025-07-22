<?php

namespace App\Services;
use App\Repositories\CampaignRepository;
use App\Services\Interfaces\CampaignServiceInterface;

class CampaignService implements CampaignServiceInterface
{
    protected $campaignRepository;

    public function __construct(CampaignRepository $campaignRepository)
    {
        $this->campaignRepository = $campaignRepository;
    }

    public function getAllCampaigns(array $filters = [])
    {
        return $this->campaignRepository->all();
    }

    public function getCampaignById($id)
    {
        return $this->campaignRepository->find($id);
    }

    public function createCampaign(array $data)
    {
        return $this->campaignRepository->create($data);
    }

    public function updateCampaign($id, array $data)
    {
        return $this->campaignRepository->update($id, $data);
    }

    public function deleteCampaign($id)
    {
        return $this->campaignRepository->delete($id);
    }

    public function getCampaignsByUser($userId)
    {
        return $this->campaignRepository->findByUser($userId);
    }

    public function getCampaignsByType($typeId)
    {
        return $this->campaignRepository->findByType($typeId);
    }
}
