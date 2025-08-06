<?php

namespace App\Services;

use App\Services\Interfaces\ContentServiceInterface;
use App\Repositories\Interfaces\ContentRepositoryInterface;

class ContentService implements ContentServiceInterface
{
    private ContentRepositoryInterface $ContentRepository;

    public function __construct(ContentRepositoryInterface $ContentRepository)
    {
        $this->ContentRepository = $ContentRepository;
    }

    public function getTopCampaignsWithStats()
    {
        return $this->ContentRepository->getTopCampaignsWithStats();
    }
}
