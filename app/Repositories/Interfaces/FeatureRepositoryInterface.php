<?php

namespace App\Repositories\Interfaces;

interface FeatureRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function findBy(array $data);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
