<?php

namespace App\Repositories;

use App\DTOs\TarifUser\TarifUserDto;
use App\Models\TarifUser;
use App\Models\Tarif;
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

    public function create(TarifUserDto $tarifUserDto) :  TarifUser
    {
        return $this->model->create($tarifUserDto->toArray());
    }

    public function update(int $id, TarifUserDto $tarifUserDto) : TarifUser
    {
        $tarifUser = $this->model->findOrFail($id);
        $tarifUser->update($tarifUserDto->toArray());
        return $tarifUser;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    public function assignFreeTarifToUser(int $userId)
    {
        $freeTarif = Tarif::where('name', 'Free')->first();

        return $this->model->create([
            'user_id' => $userId,
            'tarif_id' => $freeTarif->id,
        ]);
    }
}
