<?php

namespace App\Repositories;

use App\DTOs\Campaign\CampaignDto;
use App\Enums\StatusEnum;
use App\Models\Campaign;
use App\Repositories\Interfaces\CampaignRepositoryInterface;

class CampaignRepository implements CampaignRepositoryInterface
{
    protected $model;

    public function __construct(Campaign $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model
            ->withCount(['images', 'landingPages', 'socialPosts'])
            ->withSum('interactions as total_views', 'views')
            ->withSum('interactions as total_likes', 'likes')
            ->withSum('interactions as total_shares', 'shares')
            ->orderByDesc('created_at')
            ->limit(3)
            ->get();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function findByCriteria(array $criteria)
    {
        $query = $this->model->query();

        foreach ($criteria as $field => $value) {
            if ($field === 'status') {
                $this->applyStatusFilter($query, $value);
                continue;
            }

            if (is_numeric($value)) {
                $query->where($field, $value);
            } else {
                $query->whereRaw('LOWER(' . $field . ') = ?', [strtolower($value)]);
            }
        }

        return $query->get();
    }

    protected function applyStatusFilter($query, $value)
    {
        if (is_numeric($value)) {
            $query->where('status', $value);
            return;
        }

        try {
            $statusEnum = StatusEnum::fromLabel(strtolower($value));
            $query->where('status', $statusEnum->value);
        } catch (\ValueError $e) {

            throw new \InvalidArgumentException("Invalid status value: {$value}");
        }
    }

    public function create(CampaignDto $campaignDto) : Campaign
    {
        return $this->model->create($campaignDto->toArray());
    }

    public function update(int $id, CampaignDto $campaignDto) : Campaign
    {
        $campaign = $this->model->findOrFail($id);
        $campaign->update($campaignDto->toArray());
        return $campaign;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function findByUserId(int $userId)
    {
        $query = $this->model->query();
        $query->where('user_id', $userId);
        return $query->get();
    }

    public function findByTypeCampaignId(int $typeCampaignId, ?int $userId = null)
    {
        $query = $this->model->where('type_campaign_id', $typeCampaignId);

        if ($userId && !auth()->user()->isAdmin()) {
            $query->where('user_id', $userId);
        }

        return $query->get();
    }
}
