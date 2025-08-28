<?php

namespace App\Services;

use App\Repositories\TemplateRatingRepository;
use App\Services\Interfaces\TemplateRatingServiceInterface;

class TemplateRatingService implements TemplateRatingServiceInterface
{
    protected TemplateRatingRepository $repository;

    public function __construct(TemplateRatingRepository $repository)
    {
        $this->repository = $repository;
    }

    public function getAllRatings(array $filters = [])
    {
        return $this->repository->all($filters);
    }

    public function getRatingById(int $id)
    {
        return $this->repository->find($id);
    }

    public function upsertRating(int $templateId, int $userId, float $rating)
    {
        return $this->repository->upsert($templateId, $userId, $rating);
    }

    public function deleteRating(int $id)
    {
        return $this->repository->delete($id);
    }

    public function getAverageRating(int $templateId)
    {
        return $this->repository->averageRating($templateId);
    }
}
