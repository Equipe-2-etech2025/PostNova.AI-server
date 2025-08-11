<?php

namespace App\Repositories;

use App\DTOs\Social\SocialDto;
use App\Models\Social;
use App\Repositories\Interfaces\SocialRepositoryInterface;

class SocialRepository implements SocialRepositoryInterface
{
    protected $model;

    public function __construct(Social $model)
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
            if (empty($value) || ! in_array($field, $availableFields)) {
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

    public function create(SocialDto $socialDto): Social
    {
        return $this->model->create($socialDto->toArray());
    }

    public function update(int $id, SocialDto $socialDto): Social
    {
        $social = $this->model->findOrFail($id);
        $social->update($socialDto->toArray());

        return $social;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
