<?php

namespace App\Repositories\Interfaces;

use App\DTOs\CampaignFeatures\CampaignFeaturesDto;
use App\Models\CampaignFeatures;

interface CampaignFeaturesRepositoryInterface
{
    public function getAll();
    public function getById(int $id);
    public function create(CampaignFeaturesDto $campaignFeaturesDto) : CampaignFeatures;
    public function update(int $id, CampaignFeaturesDto $campaignFeaturesDto) : CampaignFeatures;
    public function delete(int $id);
    public function getByCriteria(array $criteria);
}
