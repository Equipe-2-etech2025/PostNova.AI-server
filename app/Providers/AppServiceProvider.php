<?php

namespace App\Providers;

use App\Repositories\CampaignFeaturesRepository;
use App\Repositories\CampaignInteractionRepository;
use App\Repositories\CampaignRepository;
use App\Repositories\CampaignTemplateRepository;
use App\Repositories\ContentRepository;
use App\Repositories\DashboardRepository;
use App\Repositories\FeaturesRepository;
use App\Repositories\ImageRepository;
use App\Repositories\Interfaces\CampaignFeaturesRepositoryInterface;
use App\Repositories\Interfaces\CampaignInteractionRepositoryInterface;
use App\Repositories\Interfaces\CampaignRepositoryInterface;
use App\Repositories\Interfaces\CampaignTemplateRepositoryInterface;
use App\Repositories\Interfaces\ContentRepositoryInterface;
use App\Repositories\Interfaces\DashboardRepositoryInterface;
use App\Repositories\Interfaces\FeaturesRepositoryInterface;
use App\Repositories\Interfaces\ImageRepositoryInterface;
use App\Repositories\Interfaces\LandingPageRepositoryInterface;
use App\Repositories\Interfaces\PromptRepositoryInterface;
use App\Repositories\Interfaces\SocialPostRepositoryInterface;
use App\Repositories\Interfaces\SocialRepositoryInterface;
use App\Repositories\Interfaces\TarifFeatureRepositoryInterface;
use App\Repositories\Interfaces\TarifRepositoryInterface;
use App\Repositories\Interfaces\TarifUserRepositoryInterface;
use App\Repositories\Interfaces\TemplateRatingRepositoryInterface;
use App\Repositories\Interfaces\TypeCampaignRepositoryInterface;
use App\Repositories\LandingPageRepository;
use App\Repositories\PromptRepository;
use App\Repositories\SocialPostRepository;
use App\Repositories\SocialRepository;
use App\Repositories\TarifFeatureRepository;
use App\Repositories\TarifRepository;
use App\Repositories\TarifUserRepository;
use App\Repositories\TemplateRatingRepository;
use App\Repositories\TypeCampaignRepository;
use App\Services\CampaignCreateService\CampaignDescriptionGeneratorService;
use App\Services\CampaignCreateService\CampaignNameGeneratorService;
use App\Services\CampaignFeaturesService;
use App\Services\CampaignInteractionService;
use App\Services\CampaignService;
use App\Services\CampaignTemplateService;
use App\Services\ContentService;
use App\Services\DashboardService;
use App\Services\FeaturesService;
use App\Services\ImageService;
use App\Services\Interfaces\CampagnGenerateInterface\CampaignDescriptionGeneratorServiceInterface;
use App\Services\Interfaces\CampagnGenerateInterface\CampaignNameGeneratorServiceInterface;
use App\Services\Interfaces\CampaignFeaturesServiceInterface;
use App\Services\Interfaces\CampaignInteractionServiceInterface;
use App\Services\Interfaces\CampaignServiceInterface;
use App\Services\Interfaces\CampaignTemplateServiceInterface;
use App\Services\Interfaces\ContentServiceInterface;
use App\Services\Interfaces\DashboardServiceInterface;
use App\Services\Interfaces\FeaturesServiceInterface;
use App\Services\Interfaces\ImageServiceInterface;
use App\Services\Interfaces\LandingPageServiceInterface;
use App\Services\Interfaces\PromptServiceInterface;
use App\Services\Interfaces\SocialPostServiceInterface;
use App\Services\Interfaces\SocialServiceInterface;
use App\Services\Interfaces\SuggestionServiceInterface;
use App\Services\Interfaces\TarifFeatureServiceInterface;
use App\Services\Interfaces\TarifServiceInterface;
use App\Services\Interfaces\TarifUserServiceInterface;
use App\Services\Interfaces\TemplateRatingServiceInterface;
use App\Services\Interfaces\TypeCampaignServiceInterface;
use App\Services\Interfaces\UserServiceInterface;
use App\Services\LandingPage\LandingPageService;
use App\Services\PromptService;
use App\Services\SocialPost\SocialPostCreateService;
use App\Services\SocialPost\SocialPostGeneratorService;
use App\Services\SocialPost\SocialPostPlatformManager;
use App\Services\SocialPost\SocialPostPromptBuilder;
use App\Services\SocialPost\SocialPostRegenerateService;
use App\Services\SocialPost\SocialPostResponseParser;
use App\Services\SocialPost\SocialPostValidationService;
use App\Services\SocialPostService;
use App\Services\SocialService;
use App\Services\SuggestionService;
use App\Services\TarifFeatureService;
use App\Services\TarifService;
use App\Services\TarifUserService;
use App\Services\TemplateRatingService;
use App\Services\TypeCampaignService;
use App\Services\UserService;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(TarifFeatureRepositoryInterface::class, TarifFeatureRepository::class);
        $this->app->bind(TarifFeatureServiceInterface::class, TarifFeatureService::class);
        $this->app->bind(TarifUserRepositoryInterface::class, TarifUserRepository::class);
        $this->app->bind(TarifUserServiceInterface::class, TarifUserService::class);
        $this->app->bind(TarifRepositoryInterface::class, TarifRepository::class);
        $this->app->bind(TarifServiceInterface::class, TarifService::class);
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
        $this->app->bind(DashboardServiceInterface::class, DashboardService::class);
        $this->app->bind(DashboardRepositoryInterface::class, DashboardRepository::class);
        $this->app->bind(ContentServiceInterface::class, ContentService::class);
        $this->app->bind(ContentRepositoryInterface::class, ContentRepository::class);
        $this->app->bind(SuggestionServiceInterface::class, SuggestionService::class);
        $this->app->bind(UserServiceInterface::class, UserService::class);
        $this->app->bind(
            CampaignNameGeneratorServiceInterface::class,
            CampaignNameGeneratorService::class
        );
        $this->app->bind(
            CampaignInteractionServiceInterface::class,
            CampaignInteractionService::class
        );

        $this->app->bind(
            CampaignInteractionRepositoryInterface::class,
            CampaignInteractionRepository::class
        );

        $this->app->bind(
            CampaignDescriptionGeneratorServiceInterface::class,
            CampaignDescriptionGeneratorService::class
        );

        $this->app->bind(CampaignTemplateRepositoryInterface::class, CampaignTemplateRepository::class);
        $this->app->bind(CampaignTemplateServiceInterface::class, CampaignTemplateService::class);
        $this->app->bind(TemplateRatingRepositoryInterface::class, TemplateRatingRepository::class);
        $this->app->bind(TemplateRatingServiceInterface::class, TemplateRatingService::class);
        $this->app->singleton(SocialPostPlatformManager::class);
        $this->app->singleton(SocialPostValidationService::class);

        $this->app->bind(SocialPostPromptBuilder::class, function ($app) {
            return new SocialPostPromptBuilder($app->make(SocialPostPlatformManager::class));
        });

        $this->app->bind(SocialPostResponseParser::class, function ($app) {
            return new SocialPostResponseParser($app->make(SocialPostPlatformManager::class));
        });

        $this->app->bind(SocialPostGeneratorService::class, function ($app) {
            return new SocialPostGeneratorService(
                $app->make(CampaignRepositoryInterface::class),
                $app->make(SocialPostPlatformManager::class),
                $app->make(SocialPostPromptBuilder::class),
                $app->make(SocialPostResponseParser::class)
            );
        });

        $this->app->bind(SocialPostCreateService::class, function ($app) {
            return new SocialPostCreateService(
                $app->make(SocialPostRepository::class),
                $app->make(CampaignRepositoryInterface::class),
                $app->make(SocialPostGeneratorService::class),
            );
        });

        $this->app->bind(SocialPostRegenerateService::class, function ($app) {
            return new SocialPostRegenerateService(
                $app->make(SocialPostRepositoryInterface::class),
                $app->make(CampaignRepositoryInterface::class),
                $app->make(SocialPostGeneratorService::class),
            );
        });

        $this->app->bind(SocialPostRepositoryInterface::class, SocialPostRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if (config('app.env') !== 'production') {
            URL::forceRootUrl(config('app.url'));
        }
    }
}
