<?php

namespace App\Repositories;

use App\Models\Campaign;
use App\Repositories\Interfaces\ContentRepositoryInterface;
use Illuminate\Support\Facades\DB;

class ContentRepository implements ContentRepositoryInterface
{
    public function getTopCampaignsWithStats()
    {
        // Sous-requête pour agréger les vues et likes par campagne
        $interactionSums = DB::table('campaign_interactions')
            ->select(
                'campaign_id',
                DB::raw('SUM(views) as total_views'),
                DB::raw('SUM(likes) as total_likes')
            )
            ->groupBy('campaign_id');

        // Jointure avec les campagnes et images publiées
        $topCampaigns = Campaign::select(
            'campaigns.id',
            'campaigns.name',
            'campaigns.description',
            'campaigns.type_campaign_id',
            'images.path as image_path',
            'stats.total_views',
            'stats.total_likes'
        )
            ->joinSub($interactionSums, 'stats', 'campaigns.id', '=', 'stats.campaign_id')
            ->join('images', function ($join) {
                $join->on('campaigns.id', '=', 'images.campaign_id')
                    ->where('images.is_published', true);
            })
            ->orderByDesc('stats.total_views')
            ->take(3)
            ->get();

        // Calcul total vues et likes de toutes les 3 campagnes
        $totalViews = $topCampaigns->sum('total_views');
        $totalLikes = $topCampaigns->sum('total_likes');

        return [
            'campaigns' => $topCampaigns,
            'totals' => [
                'views' => $totalViews,
                'likes' => $totalLikes,
            ],
        ];
    }
}
