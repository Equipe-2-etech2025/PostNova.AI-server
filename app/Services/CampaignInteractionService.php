<?php

namespace App\Services;

use App\DTOs\CampaignInteraction\CampaignInteractionDto;
use App\Repositories\Interfaces\CampaignInteractionRepositoryInterface;
use App\Services\Interfaces\CampaignInteractionServiceInterface;

class CampaignInteractionService implements CampaignInteractionServiceInterface
{
    public function __construct(
        protected CampaignInteractionRepositoryInterface $repository
    ) {}

    public function getAllInteractions()
    {
        return $this->repository->getAll();
    }

    public function getInteractionById(int $id)
    {
        return $this->repository->getById($id);
    }

    public function createInteraction(CampaignInteractionDto $dto)
    {
        return $this->repository->create($dto);
    }

    public function updateInteraction(int $id, CampaignInteractionDto $dto)
    {
        return $this->repository->update($id, $dto);
    }

    public function deleteInteraction(int $id): bool
    {
        return $this->repository->delete($id);
    }

    public function getInteractionsByCriteria(array $criteria)
    {
        return $this->repository->getByCriteria($criteria);
    }

    public function getInteractionsByCampaignId(int $campaignId)
    {
        return $this->repository->getByCampaignId($campaignId);
    }

    public function getCampaignTotalLikes(int $campaignId): int
    {
        return $this->repository->getTotalLikes($campaignId);
    }

    public function getCampaignTotalViews(int $campaignId): int
    {
        return $this->repository->getTotalViews($campaignId);
    }

    public function getCampaignTotalShares(int $campaignId): int
    {
        return $this->repository->getTotalShares($campaignId);
    }
}
