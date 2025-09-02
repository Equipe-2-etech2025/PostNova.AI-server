<?php

namespace App\Repositories;

use App\Models\CampaignInteraction;
use App\Repositories\Interfaces\DashboardRepositoryInterface;

class DashboardRepository implements DashboardRepositoryInterface
{
    /**
     * Récupère les totaux des vues, likes et shares
     * effectués par les autres utilisateurs
     * envers les campagnes créées par $userId.
     */
    public function getStatsFromOthers(int $userId): array
    {
        return CampaignInteraction::whereHas('campaign', function ($query) use ($userId) {
            $query->where('user_id', $userId);
        })
            ->selectRaw('
                COALESCE(SUM(views), 0) as total_views,
                COALESCE(SUM(likes), 0) as total_likes,
                COALESCE(SUM(shares), 0) as total_shares
            ')
            ->first()
            ->toArray();
    }
}
