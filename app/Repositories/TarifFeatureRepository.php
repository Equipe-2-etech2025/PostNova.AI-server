<?php

namespace App\Repositories;

use App\DTOs\TarifFeatures\TarifFeatureDto;
use App\Models\TarifFeature;
use App\Repositories\Interfaces\TarifFeatureRepositoryInterface;

class TarifFeatureRepository implements TarifFeatureRepositoryInterface
{
    protected $model;

    public function __construct(TarifFeature $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function findBy(array $criteria)
    {
        $query = $this->model->query();

        $availableFields = ['id', 'name', 'tarif_id'];
        $searchableFields = ['name'];

        foreach ($criteria as $field => $value) {
            if (empty($value) || !in_array($field, $availableFields)) {
                continue;
            }

            if (is_numeric($value)) {
                $query->where($field, $value);
            }
            else if (in_array($field, $searchableFields)) {
                $query->whereRaw('LOWER('.$field.') LIKE ?', ['%'.strtolower($value).'%']);
            } else {
                $query->where($field, $value);
            }
        }

        return $query->get();
    }


    public function create(TarifFeatureDto $tarifFeatureDto) : TarifFeature
    {
        return $this->model->create($tarifFeatureDto->toArray());
    }

    public function update(int $id, TarifFeatureDto $tarifFeatureDto) : TarifFeature
    {
        $item = $this->model->findOrFail($id);
        $item->update($tarifFeatureDto->toArray());
        return $item;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
