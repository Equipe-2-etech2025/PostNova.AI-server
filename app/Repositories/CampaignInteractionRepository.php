<?php

namespace App\Repositories;

use App\DTOs\CampaignInteraction\CampaignInteractionDto;
use App\Models\CampaignInteraction;
use App\Repositories\Interfaces\CampaignInteractionRepositoryInterface;

class CampaignInteractionRepository implements CampaignInteractionRepositoryInterface
{
    protected $model;

    public function __construct(CampaignInteraction $campaignInteraction)
    {
        $this->model = $campaignInteraction;
    }

    public function getAll()
    {
        return $this->model->with(['user', 'campaign'])->get();
    }

    public function getById(int $id)
    {
        return $this->model->with(['user', 'campaign'])->findOrFail($id);
    }

    public function create(CampaignInteractionDto $dto): CampaignInteraction
    {
        return $this->model->create($dto->toArray());
    }

    public function update(int $id, CampaignInteraction $dto): CampaignInteraction
    {
        $interaction = $this->model->findOrFail($id);
        $interaction->update($dto->toArray());

        return $interaction->fresh();
    }

    public function delete(int $id): bool
    {
        return $this->model->findOrFail($id)->delete();
    }

    public function getByCriteria(array $criteria)
    {
        $query = $this->model->with(['user', 'campaign']);

        foreach ($criteria as $field => $value) {
            if (is_array($value)) {
                $query->whereIn($field, $value);
            } else {
                $query->where($field, $value);
            }
        }

        return $query->get();
    }

    public function getByCampaignId(int $campaignId)
    {
        return $this->model->where('campaign_id', $campaignId)->get();
    }

    public function getTotalLikes(int $campaignId): int
    {
        return $this->model->where('campaign_id', $campaignId)->sum('likes');
    }

    public function getTotalViews(int $campaignId): int
    {
        return $this->model->where('campaign_id', $campaignId)->sum('views');
    }

    public function getTotalShares(int $campaignId): int
    {
        return $this->model->where('campaign_id', $campaignId)->sum('shares');
    }

    public function deleteByCampaignAndUser(int $campaignId, int $userId): bool
    {
        return $this->model
            ->where('campaign_id', $campaignId)
            ->where('user_id', $userId)
            ->where('likes', '>', 0)
            ->delete() > 0;
    }
}
