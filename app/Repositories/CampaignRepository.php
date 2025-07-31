<?php

namespace App\Repositories;

use App\DTOs\Campaign\CampaignDto;
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
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function findByCriteria(array $criteria)
    {
        $query = $this->model->query();

        foreach ($criteria as $field => $value) {
            if (is_numeric($value)) {
                $query->where($field, $value);
            } else {
                $query->whereRaw('LOWER(' . $field . ') = ?', [strtolower($value)]);
            }
        }

        return $query->get();
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
}
