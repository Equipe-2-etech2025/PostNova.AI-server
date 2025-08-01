<?php

namespace App\Services;

use App\DTOs\TarifFeatures\TarifFeatureDto;
use App\DTOs\TarifUser\TarifUserDto;
use App\Models\TarifFeature;
use App\Repositories\Interfaces\TarifFeatureRepositoryInterface;
use App\Services\Interfaces\TarifFeatureServiceInterface;

class TarifFeatureService implements TarifFeatureServiceInterface
{
    protected $repository;

    public function __construct(TarifFeatureRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTarifFeatures(array $filters = [])
    {
        return $this->repository->all();
    }

    public function getTarifFeatureById(int $id)
    {
        return $this->repository->find($id);
    }

    public function getTarifFeatureByCriteria(array $criteria)
    {
        return $this->repository->findBy($criteria);
    }

    public function createTarifFeature(TarifFeatureDto  $tarifFeatureDto)
    {
        return $this->repository->create($tarifFeatureDto);
    }

    public function updateTarifFeature(int $id, tarifFeatureDto $tarifFeatureDto)
    {
        return $this->repository->update($id, $tarifFeatureDto);
    }

    public function deleteTarifFeature(int $id)
    {
        return $this->repository->delete($id);
    }
}
