<?php

namespace App\Services\Interfaces;

use App\DTOs\Tarif\TarifDto;

interface TarifServiceInterface
{
    public function getAllTarifs(array $filters = []);
    public function getTarifById(int $id);
    public function getTarifByCriteria(array $criteria);
    public function createTarif(TarifDto $tarifDto);
    public function updateTarif(int $id, TarifDto $tarifDto);
    public function deleteTarif(int $id);
}
