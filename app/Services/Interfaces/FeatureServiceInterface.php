<?php

namespace App\Services\Interfaces;
interface FeatureServiceInterface
{
        public function getAllFeature();
        public function getFeatureById(int $id);
        public function getFeatureByCriteria(array $data);
        public function updateFeature(array $data, int $id);
        public function createFeature(array $data);
        public function deleteFeature(int $id);
}
