<?php

namespace App\Services;

use App\DTOs\Tarif\TarifDto;
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

    public function createTarif(TarifDto $tarifDto)
    {
        return $this->repository->create($tarifDto);
    }

    public function updateTarif(int $id, TarifDto $tarifDto)
    {
        return $this->repository->update($id, $tarifDto);
    }

    public function deleteTarif(int $id)
    {
        return $this->repository->delete($id);
    }
}
