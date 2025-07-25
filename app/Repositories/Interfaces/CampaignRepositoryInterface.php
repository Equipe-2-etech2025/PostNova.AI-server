<?php

namespace App\Repositories\Interfaces;

interface CampaignRepositoryInterface
{
    public function all();
    public function find(int $id);
    public function findByCriteria(array $criteria);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
}
