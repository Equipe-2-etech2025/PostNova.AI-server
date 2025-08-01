<?php

namespace App\Repositories\Interfaces;

interface ImageRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function findBy(array $criteria);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function findByUserId(int $userId);
}
