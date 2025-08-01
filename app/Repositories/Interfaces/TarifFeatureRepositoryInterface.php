<?php

namespace App\Repositories\Interfaces;

use App\DTOs\TarifFeatures\TarifFeatureDto;
use App\Models\TarifFeature;

interface TarifFeatureRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function findBy(array $criteria);
    public function create(TarifFeatureDto $tarifFeatureDto) : TarifFeature;
    public function update(int $id, TarifFeatureDto $tarifFeatureDto) : TarifFeature;
    public function delete(int $id);
}
