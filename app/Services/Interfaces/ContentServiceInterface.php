<?php

namespace App\Services\Interfaces;

interface ContentServiceInterface
{
    /**
     * Retourne les statistiques d'interactions des autres utilisateurs
     * sur les campagnes créées par l'utilisateur.
     */
    public function getTopCampaignsWithStats();
}
