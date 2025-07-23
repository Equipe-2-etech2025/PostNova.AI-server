<?php

namespace App\Repositories;

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

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $social = $this->model->findOrFail($id);
        $social->update($data);
        return $social;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function findBy(array $criteria)
    {
        $query = $this->model->query(); // creation de requête vide

        foreach ($criteria as $column => $value) {
            $query->where($column, $value);
        }
        return $query->get();
    }
}
