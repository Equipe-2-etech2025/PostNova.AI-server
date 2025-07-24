<?php

namespace App\Services;

use App\Repositories\Interfaces\TarifUserRepositoryInterface;
use App\Services\Interfaces\TarifUserServiceInterface;

class TarifUserService implements TarifUserServiceInterface
{
    protected $repository;

    public function __construct(TarifUserRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTarifUsers(array $filters = [])
    {
        return $this->repository->all();
    }

    public function getTarifUserById(int $id)
    {
        return $this->repository->find($id);
    }

    public function getTarifUserByCriteria(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function createTarifUser(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateTarifUser(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteTarifUser(int $id)
    {
        return $this->repository->delete($id);
    }
}
