<?php
namespace App\Services\Interfaces;

interface CampaignTemplateServiceInterface
{
    public function getAllTemplates(array $filters = []);
    public function getTemplateById(int $id);
    public function createTemplate(array $data);
    public function updateTemplate(int $id, array $data);
    public function deleteTemplate(int $id);
    public function getTemplatesByCategory(string $category);
    public function getTemplatesByTypeCampaignId(int $typeCampaignId);
    public function getAllTemplatesWithStats();
}
