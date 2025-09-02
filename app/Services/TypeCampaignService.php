<?php

namespace App\Services;

use App\DTOs\TypeCampaign\TypeCampaignDto;
use App\Repositories\TypeCampaignRepository;
use App\Services\Interfaces\TypeCampaignServiceInterface;

class TypeCampaignService implements TypeCampaignServiceInterface
{
    protected $typeCampaignRepository;

    public function __construct(TypeCampaignRepository $typeCampaignRepository)
    {
        $this->typeCampaignRepository = $typeCampaignRepository;
    }

    public function getAllTypeCampaign(array $filters = [])
    {
        return $this->typeCampaignRepository->all();
    }

    public function getTypeCampaignById(int $id)
    {
        return $this->typeCampaignRepository->find($id);
    }

    public function getTypeCampaignByCriteria(array $criteria)
    {
        return $this->typeCampaignRepository->findBy($criteria);
    }

    public function updateTypeCampaign(int $id, TypeCampaignDto $typeCampaignDto)
    {
        return $this->typeCampaignRepository->update($id, $typeCampaignDto);
    }

    public function createTypeCampaign(TypeCampaignDto $typeCampaignDto)
    {
        return $this->typeCampaignRepository->create($typeCampaignDto);
    }

    public function deleteTypeCampaign(int $id)
    {
        return $this->typeCampaignRepository->delete($id);
    }
}
