<?php

namespace App\Services\Interfaces;

use App\DTOs\TarifFeatures\TarifFeatureDto;

interface TarifFeatureServiceInterface
{
    public function getAllTarifFeatures(array $filters = []);
    public function getTarifFeatureById(int $id);
    public function getTarifFeatureByCriteria(array $criteria);
    public function createTarifFeature(TarifFeatureDto $tarifFeatureDto);
    public function updateTarifFeature(int $id, TarifFeatureDto $tarifFeatureDto);
    public function deleteTarifFeature(int $id);
}
