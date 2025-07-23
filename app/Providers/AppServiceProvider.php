<?php

namespace App\Providers;
use App\Repositories\CampaignRepository;
use App\Repositories\FeatureRepository;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Repositories\Interfaces\FeatureRepositoryInterface;
use App\Repositories\Interfaces\TypeCampaignRepositoryInterface;
use App\Repositories\TypeCampaignRepository;
use App\Services\FeatureService;
use App\Services\Interfaces\FeatureServiceInterface;
use App\Services\Interfaces\SocialServiceInterface;
use App\Services\Interfaces\TypeCampaignServiceInterface;
use App\Services\SocialService;
use App\Services\TypeCampaignService;
use Illuminate\Support\ServiceProvider;
use App\Services\Interfaces\CampaignServiceInterface;
use App\Services\CampaignService;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SocialServiceInterface::class, SocialService::class);
        $this->app->bind(TypeCampaignRepositoryInterface::class, TypeCampaignRepository::class);
        $this->app->bind(TypeCampaignServiceInterface::class, TypeCampaignService::class);
        $this->app->bind(FeatureRepositoryInterface::class, FeatureRepository::class);
        $this->app->bind(FeatureServiceInterface::class, FeatureService::class);
        $this->app->bind(CampaignServiceInterface::class, CampaignService::class);
        $this->app->bind(CampaignRepositoryInterface::class, CampaignRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
