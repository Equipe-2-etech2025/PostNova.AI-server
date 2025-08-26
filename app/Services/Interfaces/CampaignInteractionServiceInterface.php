<?php

namespace App\Services\Interfaces;

use App\DTOs\CampaignInteraction\CampaignInteractionDto;

interface CampaignInteractionServiceInterface
{
    public function getAllInteractions();

    public function getInteractionById(int $id);

    public function createInteraction(CampaignInteractionDto $dto);

    public function updateInteraction(int $id, CampaignInteractionDto $dto);

    public function deleteInteraction(int $id): bool;

    public function getInteractionsByCriteria(array $criteria);

    // Méthodes spécifiques aux interactions
    public function getInteractionsByCampaignId(int $campaignId);

    public function getCampaignTotalLikes(int $campaignId): int;

    public function getCampaignTotalViews(int $campaignId): int;

    public function getCampaignTotalShares(int $campaignId): int;

    public function deleteInteractionByCampaignAndUser(int $campaignId, int $userId);
}
