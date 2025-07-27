<?php

namespace App\Repositories;

use App\Models\TypeCampaign;
use App\Repositories\Interfaces\TypeCampaignRepositoryInterface;

class TypeCampaignRepository implements TypeCampaignRepositoryInterface
{
    protected $model;

    public function __construct(TypeCampaign $model)
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

    public function create(array $data)
    {
        return $this->model->create($data);
    }

    public function update(int $id, array $data)
    {
        $typeCampaign = $this->model->findOrFail($id);
        $typeCampaign->update($data);
        return $typeCampaign;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
