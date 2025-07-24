<?php

namespace App\Repositories;

use App\Models\CampaignFeatures;
use App\Repositories\Interfaces\CampaignFeaturesRepositoryInterface;

class CampaignFeaturesRepository implements CampaignFeaturesRepositoryInterface
{
    public function getAll()
    {
        return CampaignFeatures::all();
    }

    public function getById(int $id)
    {
        return CampaignFeatures::findOrFail($id);
    }

    public function create(array $data)
    {
        return CampaignFeatures::create($data);
    }

    public function update(int $id, array $data)
    {
        $item = CampaignFeatures::findOrFail($id);
        $item->update($data);
        return $item;
    }

    public function delete(int $id)
    {
        $item = CampaignFeatures::findOrFail($id);
        return $item->delete();
    }

    public function getByCriteria(array $criteria)
    {
        $query = CampaignFeatures::query();
        foreach ($criteria as $key => $value) {
            $query->where($key, $value);
        }
        return $query->get();
    }
}
