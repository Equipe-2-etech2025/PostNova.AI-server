<?php
namespace App\Services\Interfaces;

use App\DTOs\Campaign\CampaignDto;

interface CampaignServiceInterface
{
    public function getAllCampaigns(array $filters = []);
    public function getCampaignById(int $id);
    public function getCampaignByCriteria(array $criteria = []);
    public function createCampaign(CampaignDto $campaignDto);
    public function updateCampaign(int $campaignId, CampaignDto $campaignDto);
    public function deleteCampaign(int $id);
    public function getCampaignsByUserId(int $userId);
    public function getCampaignsByType(int $typeId);
}
