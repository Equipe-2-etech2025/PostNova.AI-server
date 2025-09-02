<?php

namespace App\Repositories\Interfaces;

interface DashboardRepositoryInterface
{
    /**
     * Retourne les totaux (vues, likes, shares)
     * des autres utilisateurs sur les campagnes
     * créées par l'utilisateur donné.
     */
    public function getStatsFromOthers(int $userId): array;
}
