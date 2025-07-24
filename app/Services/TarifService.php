<?php

namespace App\Services;

use App\Repositories\Interfaces\TarifRepositoryInterface;
use App\Services\Interfaces\TarifServiceInterface;

class TarifService implements TarifServiceInterface
{
    protected $repository;

    public function __construct(TarifRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTarifs(array $filters = [])
    {
        return $this->repository->all();
    }

    public function getTarifById(int $id)
    {
        return $this->repository->find($id);
    }

    public function getTarifByCriteria(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function createTarif(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateTarif(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteTarif(int $id)
    {
        return $this->repository->delete($id);
    }
}
