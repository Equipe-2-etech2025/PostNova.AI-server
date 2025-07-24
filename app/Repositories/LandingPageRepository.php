<?php

namespace App\Repositories;

use App\Models\LandingPage;
use App\Repositories\Interfaces\LandingPageRepositoryInterface;

class LandingPageRepository implements LandingPageRepositoryInterface
{
    protected $model;

    public function __construct(LandingPage $model)
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
        $landingPage = $this->model->findOrFail($id);
        $landingPage->update($data);
        return $landingPage;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
