<?php

namespace App\Repositories;

use App\Models\TarifUser;
use App\Repositories\Interfaces\TarifUserRepositoryInterface;

class TarifUserRepository implements TarifUserRepositoryInterface
{
    protected $model;

    public function __construct(TarifUser $model)
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

    public function findLatestByUserId(int $userId)
    {
        return $this->model
            ->with('tarif')
            ->where('user_id', $userId)
            ->orderByDesc('created_at')
            ->first();
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
        $tarifUser = $this->model->findOrFail($id);
        $tarifUser->update($data);
        return $tarifUser;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }
}
