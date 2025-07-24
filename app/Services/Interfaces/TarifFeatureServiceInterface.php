<?php

namespace App\Services\Interfaces;

interface TarifFeatureServiceInterface
{
    public function getAllTarifFeatures(array $filters = []);
    public function getTarifFeatureById(int $id);
    public function getTarifFeatureByCriteria(array $criteria);
    public function createTarifFeature(array $data);
    public function updateTarifFeature(int $id, array $data);
    public function deleteTarifFeature(int $id);
}
