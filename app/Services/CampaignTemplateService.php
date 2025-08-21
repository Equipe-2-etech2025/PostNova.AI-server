<?php

namespace App\Services;

use App\Repositories\CampaignTemplateRepository;
use App\Services\Interfaces\CampaignTemplateServiceInterface;

class CampaignTemplateService implements CampaignTemplateServiceInterface
{
    protected CampaignTemplateRepository $repository;

    public function __construct(CampaignTemplateRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllTemplates(array $filters = [])
    {
        return $this->repository->all($filters);
    }

    public function getTemplateById(int $id)
    {
        return $this->repository->find($id);
    }

    public function createTemplate(array $data)
    {
        return $this->repository->create($data);
    }

    public function updateTemplate(int $id, array $data)
    {
        return $this->repository->update($id, $data);
    }

    public function deleteTemplate(int $id)
    {
        return $this->repository->delete($id);
    }

    public function getTemplatesByCategory(string $category)
    {
        return $this->repository->findByCategory($category);
    }

    public function getTemplatesByTypeCampaignId(int $typeCampaignId)
    {
        return $this->repository->findByTypeCampaignId($typeCampaignId);
    }

    public function getAllTemplatesWithStats()
    {
        return $this->repository->allWithAggregates();
    }
}
