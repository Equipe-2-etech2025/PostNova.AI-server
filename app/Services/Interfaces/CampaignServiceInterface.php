<?php

namespace App\Services\Interfaces;

interface CampaignServiceInterface
{
    public function getAllCampaigns(array $filters = []);
    public function getCampaignById(int $id);
    public function createCampaign(array $data);
    public function updateCampaign(int $id, array $data);
    public function deleteCampaign(int $id);
    public function getCampaignsByUser(int $userId);
    public function getCampaignsByType(int $typeId);
}
