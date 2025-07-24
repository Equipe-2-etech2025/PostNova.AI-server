<?php

namespace App\Repositories\Interfaces;

interface CampaignRepositoryInterface
{
    public function all();
    public function findById($id);
    public function create(array $data);
    public function update($id, array $data);
    public function delete($id);
    public function findByUser($userId);
    public function findByType($typeId);
}
