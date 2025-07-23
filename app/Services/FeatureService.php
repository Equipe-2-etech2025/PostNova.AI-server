<?php

namespace App\Services;

use App\Repositories\FeatureRepository;
use App\Services\Interfaces\FeatureServiceInterface;

class FeatureService implements  FeatureServiceInterface
{
    protected FeatureRepository $featureRepository;

    public function __construct(FeatureRepository $featureRepository)
    {
        $this->featureRepository = $featureRepository;
    }

    public function getAllFeature()
    {
        return $this->featureRepository->all();
    }

    public function getFeatureById(int $id)
    {
        return $this->featureRepository->find($id);
    }

    public function getFeatureByCriteria(array $data)
    {
        return $this->featureRepository->findBy($data);
    }

    public function updateFeature(array $data, int $id)
    {
        return $this->featureRepository->update($data, $id);
    }

    public function createFeature(array $data)
    {
        return  $this->featureRepository->create($data);
    }

    public function deleteFeature(int $id)
    {
        return $this->featureRepository->delete($id);
    }
}
