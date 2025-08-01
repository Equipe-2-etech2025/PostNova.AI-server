<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Campaign;
use App\Models\CampaignInteraction;
use App\Services\Interfaces\DashboardServiceInterface;

class DashboardController extends Controller
{
    private DashboardServiceInterface $dashboardService;

    public function __construct(DashboardServiceInterface $dashboardService)
    {
        $this->dashboardService = $dashboardService;
    }

    public function indicators($userId)
    {
        // Total de campagnes créées par l'utilisateur
        $totalCampaigns = Campaign::where('user_id', $userId)->count();

        // Statistiques globales de toutes les interactions (y compris celles de l'utilisateur lui-même)
        $interactions = CampaignInteraction::whereHas('campaign', fn($q) =>
            $q->where('user_id', $userId)
        );

        $totalViews = $interactions->sum('views');
        $totalLikes = $interactions->sum('likes');
        $totalShares = $interactions->sum('shares');

        $engagementRate = $totalViews > 0
            ? round(($totalLikes + $totalShares) / $totalViews * 100, 1)
            : 0;

        // Statistiques uniquement venant des autres utilisateurs via le service
        $externalStats = $this->dashboardService->getUserCampaignStats($userId);

        return response()->json([
            'success' => true,
            'data' => [
                'totalCampaigns' => $totalCampaigns,
                'totalViews' => $totalViews,
                'totalLikes' => $totalLikes,
                'totalShares' => $totalShares,
                'engagementRate' => $engagementRate,
                'externalInteractions' => [
                    'views' => $externalStats['total_views'] ?? 0,
                    'likes' => $externalStats['total_likes'] ?? 0,
                    'shares' => $externalStats['total_shares'] ?? 0,
                ],
            ],
        ]);
    }
}
