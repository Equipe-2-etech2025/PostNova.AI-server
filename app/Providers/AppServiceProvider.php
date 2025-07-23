<?php

namespace App\Providers;
use App\Services\Interfaces\SocialServiceInterface;
use App\Services\SocialService;
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
        $this->app->bind(SocialServiceInterface::class, SocialService::class);

        $this->app->bind(
            \App\Repositories\Interfaces\CampaignRepositoryInterface::class,
            \App\Repositories\CampaignRepository::class,
        );
        // Bindings des Services
        $this->app->bind(
            CampaignServiceInterface::class,
            CampaignService::class
        );
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
