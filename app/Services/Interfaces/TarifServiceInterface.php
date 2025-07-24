<?php

namespace App\Services\Interfaces;

interface TarifServiceInterface
{
    public function getAllTarifs(array $filters = []);
    public function getTarifById(int $id);
    public function getTarifByCriteria(array $criteria);
    public function createTarif(array $data);
    public function updateTarif(int $id, array $data);
    public function deleteTarif(int $id);
}
