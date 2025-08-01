<?php

namespace App\Services\Interfaces;

use App\DTOs\CampaignFeatures\CampaignFeaturesDto;

interface CampaignFeaturesServiceInterface
{
    public function getAll();
    public function getById(int $id);
    public function create(CampaignFeaturesDto $campaignFeaturesDto);
    public function update(int $id, CampaignFeaturesDto $campaignFeaturesDto);
    public function delete(int $id);
    public function getByCriteria(array $criteria);
}
