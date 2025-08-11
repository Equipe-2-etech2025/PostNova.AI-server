<?php

namespace App\Services;

use App\Repositories\Interfaces\DashboardRepositoryInterface;
use App\Services\Interfaces\DashboardServiceInterface;

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
