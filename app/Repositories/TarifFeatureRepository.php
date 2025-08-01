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

        foreach ($criteria as $field => $value) {
            if (is_numeric($value)) {
                $query->where($field, $value);
            } else {
                $query->whereRaw('LOWER(' . $field . ') = ?', [strtolower($value)]);
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
