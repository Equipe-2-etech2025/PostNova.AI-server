<?php

namespace App\Services;

use App\DTOs\TarifUser\TarifUserDto;
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

    public function createTarifUser(TarifUserDto $tarifUserDto)
    {
        return $this->repository->create($tarifUserDto);
    }

    public function updateTarifUser(int $id, TarifUserDto $tarifUserDto)
    {
        return $this->repository->update($id, $tarifUserDto);
    }

    public function deleteTarifUser(int $id)
    {
        return $this->repository->delete($id);
    }
}
