<?php

namespace App\Services\Interfaces;

use App\DTOs\Features\FeaturesDto;

interface FeaturesServiceInterface
{
    public function getAllFeatures(array $filters = []);
    public function getFeatureById(int $id);
    public function getFeatureByCriteria(array $criteria);
    public function updateFeature(int $id, FeaturesDto $featuresDto);
    public function createFeature(FeaturesDto  $featuresDto);
    public function deleteFeature(int $id);
}
