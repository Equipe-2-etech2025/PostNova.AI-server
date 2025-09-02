<?php

namespace App\Repositories\Interfaces;

interface TemplateRatingRepositoryInterface
{
    public function all(array $filters = []);

    public function find(int $id);

    public function upsert(int $templateId, int $userId, float $rating);

    public function delete(int $id);

    public function averageRating(int $templateId);
}
