<?php

namespace App\Repositories\Interfaces;

use App\DTOs\TemplateUse\TemplateUseDto;

interface TemplateUseRepositoryInterface
{
    public function all();

    public function find(int $id);

    public function findBy(array $criteria);

    public function create(TemplateUseDto $templateUseDto);

    public function update(int $id, TemplateUseDto $templateUseDto);

    public function delete(int $id);

    public function findWithRelations(int $id);

    public function allWithRelations();

    public function findByUser(int $userId);

    public function findByTemplate(int $templateId);

    public function countByTemplate(int $templateId);

    public function getUsageStats(string $period = 'month');
}
