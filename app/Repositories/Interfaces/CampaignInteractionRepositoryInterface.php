<?php

namespace App\Repositories\Interfaces;

use App\DTOs\CampaignInteraction\CampaignInteractionDto;
use App\Models\CampaignInteraction;

interface CampaignInteractionRepositoryInterface
{
    public function getAll();

    public function getById(int $id);

    public function create(CampaignInteractionDto $campaignInteractionDto): CampaignInteraction;

    public function update(int $id, CampaignInteraction $campaignInteractionDto): CampaignInteraction;

    public function delete(int $id);

    public function getByCriteria(array $criteria);

    public function deleteByCampaignAndUser(int $campaignId, int $userId);

    public function getTotalLikes(int $campaignId): int;

    public function getTotalViews(int $campaignId): int;

    public function getTotalShares(int $campaignId): int;
}
