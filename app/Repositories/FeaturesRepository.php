<?php

namespace App\Repositories;

use App\DTOs\Features\FeaturesDto;
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

        $availableFields = ['id', 'name'];
        $searchableFields = ['name'];

        foreach ($criteria as $field => $value) {
            if (empty($value) || !in_array($field, $availableFields)) {
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

    public function create(FeaturesDto $featuresDto) : Features
    {
        return $this->model->create($featuresDto->toArray());
    }

    public function update(int $id, FeaturesDto $featuresDto) : Features
    {
        $feature = $this->model->findOrFail($id);
        $feature->update($featuresDto->toArray());
        return $feature;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
