<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Features\FeaturesDto;
use App\Models\Features;

interface FeaturesRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function findBy(array $criteria);
    public function create(FeaturesDto $featuresDto) : Features;
    public function update(int $id, FeaturesDto $featuresDto) : Features;
    public function delete(int $id);
}
