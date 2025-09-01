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
            ->with(['images' => function ($query) {
                $query->select('id', 'campaign_id', 'path', 'is_published', 'created_at');
            }, 'typeCampaign', 'user'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function findByCriteria(array $criteria)
    {
        $query = $this->model->newQuery();

        $availableFields = ['id', 'name', 'description', 'user_id', 'type_campaign_id', 'status', 'is_published'];
        $searchableFields = ['name', 'description'];

        foreach ($criteria as $field => $value) {
            if (empty($value) || ! in_array($field, $availableFields)) {
                continue;
            }

            if ($field === 'status') {
                if (is_string($value)) {
                    $value = StatusEnum::fromLabel($value)->value;
                }
                $query->where('status', $value);

                continue;
            }

            if (in_array($field, $searchableFields)) {
                $query->whereRaw('LOWER('.$field.') LIKE ?', ['%'.strtolower($value).'%']);
            } else {
                $query->where($field, $value);
            }
        }

        return $query->get();
    }

    public function create(CampaignDto $campaignDto): Campaign
    {
        return $this->model->create($campaignDto->toArray());
    }

    public function update(int $id, CampaignDto $campaignDto): Campaign
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
        return $this->model
            ->where('user_id', $userId)
            ->withCount(['images', 'landingPages', 'socialPosts'])
            ->withSum('interactions as total_views', 'views')
            ->withSum('interactions as total_likes', 'likes')
            ->withSum('interactions as total_shares', 'shares')
            ->with(['images' => function ($query) {
                $query->select('id', 'campaign_id', 'path', 'is_published', 'created_at');
            }, 'typeCampaign', 'user'])
            ->orderByDesc('created_at')
            ->get();
    }

    public function findByTypeCampaignId(int $typeCampaignId, ?int $userId = null)
    {
        $query = $this->model->where('type_campaign_id', $typeCampaignId);

        if ($userId && ! auth()->user()->isAdmin()) {
            $query->where('user_id', $userId);
        }

        return $query->get();
    }
}
