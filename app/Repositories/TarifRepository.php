<?php

namespace App\Repositories;

use App\DTOs\Tarif\TarifDto;
use App\DTOs\TarifFeatures\TarifFeatureDto;
use App\Models\Tarif;
use App\Repositories\Interfaces\TarifRepositoryInterface;

class TarifRepository implements TarifRepositoryInterface
{
    protected $model;

    public function __construct(Tarif $model)
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
                $query->whereRaw('LOWER(' . $field . ') LIKE ?', [ '%'. strtolower($value). '%']);
            }
        }

        return $query->get();
    }

    public function create(TarifDto $tarifDto) : Tarif
    {
        return $this->model->create($tarifDto->toArray());
    }

    public function update(int $id, TarifDto $tarifDto) : Tarif
    {
        $tarif = $this->model->findOrFail($id);
        $tarif->update($tarifDto->toArray());
        return $tarif;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
