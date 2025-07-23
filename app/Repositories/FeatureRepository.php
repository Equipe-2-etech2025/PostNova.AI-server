<?php
namespace App\Repositories;

use App\Models\Social;
use App\Repositories\Interfaces\FeatureRepositoryInterface;
use http\Env\Request;

class FeatureRepository implements FeatureRepositoryInterface
{
    protected $model;

    public function __construct (Social $model)
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

        foreach ($criteria as $column => $value) {
            $query->where($column, $value);
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
