<?php

namespace App\Services\Interfaces;

use App\DTOs\TarifUser\TarifUserDto;

interface TarifUserServiceInterface
{
    public function getAllTarifUsers(array $filters = []);
    public function getTarifUserById(int $id);
    public function getLatestByUserId(int $id);
    public function getTarifUserByCriteria(array $criteria);
    public function createTarifUser(TarifUserDto $tarifUserDto);
    public function updateTarifUser(int $id, TarifUserDto $tarifUserDto);
    public function deleteTarifUser(int $id);
}
