<?php

namespace App\Services\Interfaces;

interface TarifUserServiceInterface
{
    public function getAllTarifUsers(array $filters = []);
    public function getTarifUserById(int $id);
    public function getLatestByUserId(int $id);
    public function getTarifUserByCriteria(array $criteria);
    public function createTarifUser(array $data);
    public function updateTarifUser(int $id, array $data);
    public function deleteTarifUser(int $id);
}
