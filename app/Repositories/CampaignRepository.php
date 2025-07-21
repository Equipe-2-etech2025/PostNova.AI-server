<?php

namespace App\Repositories;

use App\Models\Campaign;

class CampaignRepository implements CampaignRepositoryInterface
{
    protected $model;

    public function __construct(Campaign $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->with(['user', 'typeCampaign'])->get();
    }

    public function find($id)
    {
        return $this->model->with(['user', 'typeCampaign'])->findOrFail($id);
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update($id, array $data)
    {
        $campaign = $this->find($id);
        $campaign->update($data);
        return $campaign;
    }

    public function delete($id)
    {
        return $this->find($id)->delete();
    }

    public function findByUser($userId)
    {
        return $this->model->where('user_id', $userId)->with('typeCampaign')->get();
    }

    public function findByType($typeId)
    {
        return $this->model->where('type_campaign_id', $typeId)->with('user')->get();
    }
}
