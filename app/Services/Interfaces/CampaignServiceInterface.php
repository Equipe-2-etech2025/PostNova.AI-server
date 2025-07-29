<?php

namespace App\Services\Interfaces;

interface CampaignServiceInterface
{
    public function getAllCampaigns(array $filters = []);
    public function getCampaignById(int $id);
    public function getCampaignByCriteria(array $filters = []);
    public function createCampaign(array $data);
    public function updateCampaign(int $campaignId, array $data);
    public function deleteCampaign(int $id);
    public function getCampaignsByUserId(int $userId);
    public function getCampaignsByType(int $typeId);
}
