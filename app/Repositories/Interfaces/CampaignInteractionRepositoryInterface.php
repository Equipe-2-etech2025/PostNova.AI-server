<?php

namespace App\Repositories\Interfaces;

use App\DTOs\CampaignInteraction\CampaignInteractionDto;
use App\Models\CampaignInteraction;

interface CampaignInteractionRepositoryInterface
{
    public function getAll();

    public function getById(int $id);

    public function create(CampaignInteractionDto $dto): CampaignInteraction;

    public function update(int $id, CampaignInteractionDto $dto): CampaignInteraction;

    public function delete(int $id): bool;

    public function getByCriteria(array $criteria);

    public function getByCampaignId(int $campaignId);

    public function getTotalLikes(int $campaignId): int;

    public function getTotalViews(int $campaignId): int;

    public function getTotalShares(int $campaignId): int;
}
