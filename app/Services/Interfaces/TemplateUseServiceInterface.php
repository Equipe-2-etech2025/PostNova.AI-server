<?php

namespace App\Services\Interfaces;

use App\DTOs\TemplateUse\TemplateUseDto;

interface TemplateUseServiceInterface
{
    /**
     * Récupère toutes les utilisations de templates avec filtres optionnels
     */
    public function getAllTemplateUses(array $filters = []);

    /**
     * Récupère une utilisation par son ID
     */
    public function getTemplateUseById(int $id);

    /**
     * Récupère les utilisations selon des critères
     */
    public function getTemplateUseByCriteria(array $criteria);

    /**
     * Met à jour une utilisation
     */
    public function updateTemplateUse(int $id, TemplateUseDto $templateUseDto);

    /**
     * Crée une nouvelle utilisation
     */
    public function createTemplateUse(TemplateUseDto $templateUseDto);

    /**
     * Supprime une utilisation
     */
    public function deleteTemplateUse(int $id);

    /**
     * Enregistre l'utilisation d'un template par un utilisateur
     */
    public function recordTemplateUsage(int $templateId, int $userId, ?\DateTimeInterface $usedAt = null);

    /**
     * Récupère les utilisations d'un utilisateur spécifique
     */
    public function getUserTemplateUsages(int $userId);

    /**
     * Récupère les utilisations d'un template spécifique
     */
    public function getTemplateUsages(int $templateId);

    /**
     * Compte le nombre d'utilisations d'un template
     */
    public function countTemplateUsages(int $templateId): int;

    /**
     * Récupère les statistiques d'utilisation par période
     */
    public function getUsageStatistics(string $period = 'month');

    /**
     * Vérifie si un utilisateur a utilisé un template
     */
    public function hasUserUsedTemplate(int $userId, int $templateId): bool;

    /**
     * Récupère les templates les plus utilisés
     */
    public function getMostUsedTemplates(int $limit = 10);

    /**
     * Récupère les utilisateurs les plus actifs
     */
    public function getMostActiveUsers(int $limit = 10);
}
