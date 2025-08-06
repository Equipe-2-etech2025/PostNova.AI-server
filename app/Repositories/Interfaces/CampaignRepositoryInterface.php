<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Campaign\CampaignDto;
use App\Models\Campaign;

interface CampaignRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function findByCriteria(array $criteria);
    public function findByUserId(int $userId);
    public function create(CampaignDto $campaignDto) : Campaign;
    public function update(int $id, CampaignDto $campaignDto) : Campaign;
    public function delete(int $id);
    public function findByTypeCampaignId(int $typeCampaignId);
}
