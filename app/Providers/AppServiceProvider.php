<?php

namespace App\Providers;
use App\Repositories\CampaignRepository;
use App\Repositories\FeaturesRepository;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Repositories\Interfaces\FeatureRepositoryInterface;
use App\Repositories\Interfaces\FeaturesRepositoryInterface;
use App\Repositories\Interfaces\SocialRepositoryInterface;
use App\Repositories\Interfaces\TypeCampaignRepositoryInterface;
use App\Repositories\SocialRepository;
use App\Repositories\TypeCampaignRepository;
use App\Services\FeaturesService;
use App\Services\Interfaces\FeaturesServiceInterface;
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
        $this->app->bind(FeaturesRepositoryInterface::class, FeaturesRepository::class);
        $this->app->bind(FeaturesServiceInterface::class, FeaturesService::class);
        $this->app->bind(SocialRepositoryInterface::class, SocialRepository::class);
        $this->app->bind(SocialServiceInterface::class, SocialService::class);
        $this->app->bind(TypeCampaignRepositoryInterface::class, TypeCampaignRepository::class);
        $this->app->bind(TypeCampaignServiceInterface::class, TypeCampaignService::class);
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
