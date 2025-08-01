<?php

namespace App\Services;

use App\Services\Interfaces\DashboardServiceInterface;
use App\Repositories\Interfaces\DashboardRepositoryInterface;

class DashboardService implements DashboardServiceInterface
{
    private DashboardRepositoryInterface $dashboardRepository;

    public function __construct(DashboardRepositoryInterface $dashboardRepository)
    {
        $this->dashboardRepository = $dashboardRepository;
    }

    public function getUserCampaignStats(int $userId): array
    {
        return $this->dashboardRepository->getStatsFromOthers($userId);
    }
}
