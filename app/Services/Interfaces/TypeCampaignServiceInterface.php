<?php

namespace App\Services\Interfaces;

use App\DTOs\TypeCampaign\TypeCampaignDto;

interface TypeCampaignServiceInterface
{
    public function getAllTypeCampaign(array $filters = []);
    public function getTypeCampaignById(int $id);
    public function getTypeCampaignByCriteria(array $criteria);
    public function updateTypeCampaign(int $id, TypeCampaignDto $typeCampaignDto);
    public function createTypeCampaign(TypeCampaignDto $typeCampaignDto);
    public function deleteTypeCampaign(int $id);
}
