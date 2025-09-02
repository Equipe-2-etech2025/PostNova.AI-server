<?php

namespace App\Services\Interfaces;

interface DashboardServiceInterface
{
    /**
     * Retourne les statistiques d'interactions des autres utilisateurs
     * sur les campagnes créées par l'utilisateur.
     */
    public function getUserCampaignStats(int $userId): array;
}
