<?php

namespace App\Services\Interfaces;

interface TypeCampaignServiceInterface
{
    public function getAllTypeCampaign(array $filters = []);
    public function getTypeCampaignById(int $id);
    public function getTypeCampaignByCriteria(array $criteria);
    public function updateTypeCampaign(int $id, array $data);
    public function createTypeCampaign(array $data);
    public function deleteTypeCampaign(int $id);
}
