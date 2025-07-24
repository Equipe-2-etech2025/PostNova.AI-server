<?php

namespace App\Repositories;

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
            $query->where($field, $value);
        }

        return $query->get();
    }

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $tarif = $this->model->findOrFail($id);
        $tarif->update($data);
        return $tarif;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
