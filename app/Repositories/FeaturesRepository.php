<?php

namespace App\Repositories;

use App\Models\Features;
use App\Repositories\Interfaces\FeaturesRepositoryInterface;

class FeaturesRepository implements FeaturesRepositoryInterface
{
    protected $model;

    public function __construct(Features $model)
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
        $feature = $this->model->findOrFail($id);
        $feature->update($data);
        return $feature;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
