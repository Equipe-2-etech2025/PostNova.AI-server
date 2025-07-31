<?php

namespace App\Repositories;

use App\DTOs\CampaignFeatures\CampaignFeaturesDto;
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

    public function create(CampaignFeaturesDto $campaignFeaturesDto) : CampaignFeatures
    {
        return $this->model->create($campaignFeaturesDto->toArray());
    }

    public function update(int $id, CampaignFeaturesDto $campaignFeaturesDto) :  CampaignFeatures
    {
        $item = $this->model->findOrFail($id);
        $item->update($campaignFeaturesDto->toArray());
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
        foreach ($criteria as $field => $value) {
            if (is_numeric($value)) {
                $query->where($field, $value);
            } else {
                $query->whereRaw('LOWER(' . $field . ') = ?', [strtolower($value)]);
            }
        }
        return $query->get();
    }
}
