<?php

namespace App\Repositories;

use App\DTOs\TemplateUse\TemplateUseDto;
use App\Models\TemplateUse;
use App\Repositories\Interfaces\TemplateUseRepositoryInterface;

class TemplateUseRepository implements TemplateUseRepositoryInterface
{
    protected $model;

    public function __construct(TemplateUse $model)
    {
        $this->model = $model;
    }

    public function all()
    {
        return $this->model->all();
    }

    public function find(int $id)
    {
        return $this->model->find($id);
    }

    public function findBy(array $criteria)
    {
        $query = $this->model->query();

        $availableFields = ['id', 'template_id', 'user_id', 'used_at'];
        $searchableFields = []; // Pas de champs de recherche textuelle pour ce modèle

        foreach ($criteria as $field => $value) {
            if (empty($value) || ! in_array($field, $availableFields)) {
                continue;
            }

            if (in_array($field, $searchableFields)) {
                $query->whereRaw('LOWER('.$field.') LIKE ?', ['%'.strtolower($value).'%']);
            } else {
                if ($field === 'used_at' && is_array($value)) {
                    // Gestion des plages de dates
                    if (isset($value['from'])) {
                        $query->where('used_at', '>=', $value['from']);
                    }
                    if (isset($value['to'])) {
                        $query->where('used_at', '<=', $value['to']);
                    }
                } else {
                    $query->where($field, $value);
                }
            }
        }

        return $query->get();
    }

    public function create(TemplateUseDto $templateUseDto): TemplateUse
    {
        return $this->model->create($templateUseDto->toArray());
    }

    public function update(int $id, TemplateUseDto $templateUseDto): TemplateUse
    {
        $templateUse = $this->model->findOrFail($id);
        $templateUse->update($templateUseDto->toArray());

        return $templateUse;
    }

    public function delete(int $id)
    {
        return $this->model->destroy($id);
    }

    /**
     * Récupère les utilisations avec les relations chargées
     */
    public function findWithRelations(int $id)
    {
        return $this->model->with(['template', 'user'])->find($id);
    }

    /**
     * Récupère toutes les utilisations avec les relations chargées
     */
    public function allWithRelations()
    {
        return $this->model->with(['template', 'user'])->get();
    }

    /**
     * Trouve les utilisations par utilisateur
     */
    public function findByUser(int $userId)
    {
        return $this->model->where('user_id', $userId)
            ->with(['template'])
            ->orderBy('used_at', 'desc')
            ->get();
    }

    /**
     * Trouve les utilisations par template
     */
    public function findByTemplate(int $templateId)
    {
        return $this->model->where('template_id', $templateId)
            ->with(['user'])
            ->orderBy('used_at', 'desc')
            ->get();
    }

    /**
     * Compte le nombre d'utilisations par template
     */
    public function countByTemplate(int $templateId): int
    {
        return $this->model->where('template_id', $templateId)->count();
    }

    /**
     * Récupère les statistiques d'utilisation par période
     */
    public function getUsageStats(string $period = 'month')
    {
        $dateFormat = match ($period) {
            'day' => '%Y-%m-%d',
            'week' => '%Y-%u',
            'month' => '%Y-%m',
            'year' => '%Y',
            default => '%Y-%m'
        };

        return $this->model
            ->selectRaw("DATE_FORMAT(used_at, '{$dateFormat}') as period")
            ->selectRaw('COUNT(*) as usage_count')
            ->groupByRaw("DATE_FORMAT(used_at, '{$dateFormat}')")
            ->orderBy('period')
            ->get();
    }
}
