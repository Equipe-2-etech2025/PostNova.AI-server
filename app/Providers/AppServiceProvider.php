<?php

namespace App\Providers;
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
