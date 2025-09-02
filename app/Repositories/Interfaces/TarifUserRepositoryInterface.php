<?php

namespace App\Repositories\Interfaces;

use App\DTOs\TarifUser\TarifUserDto;
use App\Models\TarifUser;

interface TarifUserRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function findLatestByUserId(int $id);

    public function findBy(array $criteria);

    public function create(TarifUserDto $tarifUserDto): TarifUser;

    public function update(int $id, TarifUserDto $tarifUserDto): TarifUser;

    public function delete(int $id);

    public function assignFreeTarifToUser(int $userId);
}
