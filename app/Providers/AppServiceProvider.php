<?php

namespace App\Providers;
use App\Repositories\CampaignFeaturesRepository;
use App\Repositories\CampaignRepository;
use App\Repositories\FeaturesRepository;
use App\Repositories\ImageRepository;
use App\Repositories\Interfaces\CampaignFeaturesRepositoryInterface;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Repositories\Interfaces\FeatureRepositoryInterface;
use App\Repositories\Interfaces\FeaturesRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\LandingPageRepositoryInterface;
use App\Repositories\Interfaces\PromptRepositoryInterface;
use App\Repositories\Interfaces\SocialPostRepositoryInterface;
use App\Repositories\Interfaces\SocialRepositoryInterface;
use App\Repositories\Interfaces\TypeCampaignRepositoryInterface;
use App\Repositories\LandingPageRepository;
use App\Repositories\PromptRepository;
use App\Repositories\SocialPostRepository;
use App\Repositories\SocialRepository;
use App\Repositories\TypeCampaignRepository;
use App\Services\CampaignFeaturesService;
use App\Services\FeaturesService;
use App\Services\ImageService;
use App\Services\Interfaces\CampaignFeaturesServiceInterface;
use App\Services\Interfaces\FeaturesServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\LandingPageServiceInterface;
use App\Services\Interfaces\PromptServiceInterface;
use App\Services\Interfaces\SocialPostServiceInterface;
use App\Services\Interfaces\SocialServiceInterface;
use App\Services\Interfaces\TypeCampaignServiceInterface;
use App\Services\LandingPageService;
use App\Services\PromptService;
use App\Services\SocialPostService;
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
        $this->app->bind(SocialPostRepositoryInterface::class, SocialPostRepository::class);
        $this->app->bind(SocialPostServiceInterface::class, SocialPostService::class);
        $this->app->bind(PromptRepositoryInterface::class, PromptRepository::class);
        $this->app->bind(PromptServiceInterface::class, PromptService::class);
        $this->app->bind(LandingPageRepositoryInterface::class, LandingPageRepository::class);
        $this->app->bind(LandingPageServiceInterface::class, LandingPageService::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(ImageServiceInterface::class, ImageService::class);
        $this->app->bind(CampaignFeaturesRepositoryInterface::class, CampaignFeaturesRepository::class);
        $this->app->bind(CampaignFeaturesServiceInterface::class, CampaignFeaturesService::class);
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
