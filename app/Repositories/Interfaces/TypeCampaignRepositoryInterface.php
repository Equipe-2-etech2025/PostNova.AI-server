<?php

namespace App\Repositories\Interfaces;

use App\DTOs\TypeCampaign\TypeCampaignDto;
use App\Models\TypeCampaign;

interface TypeCampaignRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function findBy(array $criteria);
    public function create(TypeCampaignDto $typeCampaignDto) : TypeCampaign;
    public function update(int $id, TypeCampaignDto $typeCampaignDto) : TypeCampaign;
    public function delete(int $id);
}
