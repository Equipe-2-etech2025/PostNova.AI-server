<?php

namespace App\Services;

use App\DTOs\TemplateUse\TemplateUseDto;
use App\Repositories\Interfaces\TemplateUseRepositoryInterface;
use App\Services\Interfaces\TemplateUseServiceInterface;
use Carbon\Carbon;

class TemplateUseService implements TemplateUseServiceInterface
{
    protected $templateUseRepository;

    public function __construct(TemplateUseRepositoryInterface $templateUseRepository)
    {
        $this->templateUseRepository = $templateUseRepository;
    }

    public function getAllTemplateUses(array $filters = [])
    {
        if (empty($filters)) {
            return $this->templateUseRepository->allWithRelations();
        }

        return $this->templateUseRepository->findBy($filters);
    }

    public function getTemplateUseById(int $id)
    {
        return $this->templateUseRepository->findWithRelations($id);
    }

    public function getTemplateUseByCriteria(array $criteria)
    {
        return $this->templateUseRepository->findBy($criteria);
    }

    public function updateTemplateUse(int $id, TemplateUseDto $templateUseDto)
    {
        return $this->templateUseRepository->update($id, $templateUseDto);
    }

    public function createTemplateUse(TemplateUseDto $templateUseDto)
    {
        return $this->templateUseRepository->create($templateUseDto);
    }

    public function deleteTemplateUse(int $id)
    {
        return $this->templateUseRepository->delete($id);
    }

    /**
     * Enregistre l'utilisation d'un template par un utilisateur
     */
    public function recordTemplateUsage(int $templateId, int $userId, ?\DateTimeInterface $usedAt = null)
    {
        $templateUseDto = new TemplateUseDto(
            id: null,
            template_id: $templateId,
            user_id: $userId,
            used_at: $usedAt ?? Carbon::now()
        );

        return $this->createTemplateUse($templateUseDto);
    }

    /**
     * Récupère les utilisations d'un utilisateur spécifique
     */
    public function getUserTemplateUsages(int $userId)
    {
        return $this->templateUseRepository->findByUser($userId);
    }

    /**
     * Récupère les utilisations d'un template spécifique
     */
    public function getTemplateUsages(int $templateId)
    {
        return $this->templateUseRepository->findByTemplate($templateId);
    }

    /**
     * Compte le nombre d'utilisations d'un template
     */
    public function countTemplateUsages(int $templateId): int
    {
        return $this->templateUseRepository->countByTemplate($templateId);
    }

    /**
     * Récupère les statistiques d'utilisation
     */
    public function getUsageStatistics(string $period = 'month')
    {
        return $this->templateUseRepository->getUsageStats($period);
    }

    /**
     * Vérifie si un utilisateur a utilisé un template
     */
    public function hasUserUsedTemplate(int $userId, int $templateId): bool
    {
        $criteria = [
            'user_id' => $userId,
            'template_id' => $templateId,
        ];

        $results = $this->templateUseRepository->findBy($criteria);

        return $results->count() > 0;
    }

    /**
     * Récupère les templates les plus utilisés
     */
    public function getMostUsedTemplates(int $limit = 10)
    {
        return $this->templateUseRepository
            ->getModel()
            ->select('template_id')
            ->selectRaw('COUNT(*) as usage_count')
            ->with('template')
            ->groupBy('template_id')
            ->orderBy('usage_count', 'desc')
            ->limit($limit)
            ->get();
    }

    /**
     * Récupère les utilisateurs les plus actifs
     */
    public function getMostActiveUsers(int $limit = 10)
    {
        return $this->templateUseRepository
            ->getModel()
            ->select('user_id')
            ->selectRaw('COUNT(*) as usage_count')
            ->with('user')
            ->groupBy('user_id')
            ->orderBy('usage_count', 'desc')
            ->limit($limit)
            ->get();
    }
}
