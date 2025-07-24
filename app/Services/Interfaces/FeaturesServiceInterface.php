<?php

namespace App\Services\Interfaces;

interface FeaturesServiceInterface
{
    public function getAllFeatures(array $filters = []);
    public function getFeatureById(int $id);
    public function getFeatureByCriteria(array $criteria);
    public function updateFeature(int $id, array $data);
    public function createFeature(array $data);
    public function deleteFeature(int $id);
}
