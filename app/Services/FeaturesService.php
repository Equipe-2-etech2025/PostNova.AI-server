<?php

namespace App\Services;

use App\Repositories\Interfaces\FeaturesRepositoryInterface;
use App\Services\Interfaces\FeaturesServiceInterface;

class FeaturesService implements FeaturesServiceInterface
{
    protected $featuresRepository;

    public function __construct(FeaturesRepositoryInterface $featuresRepository)
    {
        $this->featuresRepository = $featuresRepository;
    }

    public function getAllFeatures(array $filters = [])
    {
        return $this->featuresRepository->all();
    }

    public function getFeatureById(int $id)
    {
        return $this->featuresRepository->find($id);
    }

    public function getFeatureByCriteria(array $criteria)
    {
        return $this->featuresRepository->findBy($criteria);
    }

    public function updateFeature(int $id, array $data)
    {
        return $this->featuresRepository->update($id, $data);
    }

    public function createFeature(array $data)
    {
        return $this->featuresRepository->create($data);
    }

    public function deleteFeature(int $id)
    {
        return $this->featuresRepository->delete($id);
    }
}
