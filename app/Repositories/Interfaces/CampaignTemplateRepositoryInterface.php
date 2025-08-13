<?php
namespace App\Repositories\Interfaces;

interface CampaignTemplateRepositoryInterface
{
    public function all(array $filters = []);
    public function find(int $id);
    public function create(array $data);
    public function update(int $id, array $data);
    public function delete(int $id);
    public function findByCategory(string $category);
    public function findByTypeCampaignId(int $typeCampaignId);
    public function allWithAggregates();
}
