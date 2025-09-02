<?php

namespace App\Repositories;

use App\Models\TemplateRating;
use App\Repositories\Interfaces\TemplateRatingRepositoryInterface;

class TemplateRatingRepository implements TemplateRatingRepositoryInterface
{
    protected TemplateRating $model;

    public function __construct(TemplateRating $model)
    {
        $this->model = $model;
    }

    /**
     * Récupérer tous les ratings
     */
    public function all(array $filters = [])
    {
        $query = $this->model->query();

        if (! empty($filters['template_id'])) {
            $query->where('template_id', $filters['template_id']);
        }

        if (! empty($filters['user_id'])) {
            $query->where('user_id', $filters['user_id']);
        }

        return $query->get();
    }

    /**
     * Trouver un rating par ID
     */
    public function find(int $id)
    {
        return $this->model->findOrFail($id);
    }

    /**
     * Créer ou mettre à jour un rating
     */
    public function upsert(int $templateId, int $userId, float $rating)
    {
        return $this->model->updateOrCreate(
            [
                'template_id' => $templateId,
                'user_id' => $userId,
            ],
            [
                'rating' => $rating,
            ]
        );
    }

    /**
     * Supprimer un rating
     */
    public function delete(int $id)
    {
        $rating = $this->model->findOrFail($id);

        return $rating->delete();
    }

    /**
     * Moyenne des ratings pour un template
     */
    public function averageRating(int $templateId)
    {
        return $this->model->where('template_id', $templateId)->avg('rating');
    }
}
