<?php

namespace App\Repositories\Interfaces;

use App\DTOs\Tarif\TarifDto;
use App\Models\Tarif;
use PhpParser\Builder\Trait_;

interface TarifRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function findBy(array $criteria);
    public function create(TarifDto $tarifDto) : Tarif;
    public function update(int $id, TarifDto $tarifDto) : Tarif;
    public function delete(int $id);
}
