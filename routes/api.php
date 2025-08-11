<?php

use App\Http\Controllers\API\Auth\AuthUser\LoginController;
use App\Http\Controllers\API\Auth\AuthUser\LogoutController;
use App\Http\Controllers\API\Auth\AuthUser\MeController;
use App\Http\Controllers\API\Auth\AuthUser\RefreshTokenController;
use App\Http\Controllers\API\Auth\AuthUser\RegisterController;
use App\Http\Controllers\API\Auth\EmailVerification\EmailVerificationStatusController;
use App\Http\Controllers\API\Auth\EmailVerification\SendEmailVerificationController;
use App\Http\Controllers\API\Auth\EmailVerification\VerifyEmailController;
use App\Http\Controllers\API\Auth\PasswordReset\ResetPasswordController;
use App\Http\Controllers\API\Auth\PasswordReset\SendPasswordResetLinkController;
use App\Http\Controllers\API\Campaign\CampaignByTypeController;
use App\Http\Controllers\API\Campaign\CampaignCriteriaController;
use App\Http\Controllers\API\Campaign\CampaignDestroyController;
use App\Http\Controllers\API\Campaign\CampaignIndexController;
use App\Http\Controllers\API\Campaign\CampaignShowController;
use App\Http\Controllers\API\Campaign\CampaignStoreController;
use App\Http\Controllers\API\Campaign\CampaignUpdateController;
use App\Http\Controllers\API\Campaign\CampaignUserController;
use App\Http\Controllers\API\CampaignFeatures\CampaignFeaturesCriteriaController;
use App\Http\Controllers\API\CampaignFeatures\CampaignFeaturesDestroyController;
use App\Http\Controllers\API\CampaignFeatures\CampaignFeaturesIndexController;
use App\Http\Controllers\API\CampaignFeatures\CampaignFeaturesShowController;
use App\Http\Controllers\API\CampaignFeatures\CampaignFeaturesStoreController;
use App\Http\Controllers\API\CampaignFeatures\CampaignFeaturesUpdateController;
use App\Http\Controllers\API\Dashboard\DashboardController;
use App\Http\Controllers\API\Features\FeaturesCriteriaController;
use App\Http\Controllers\API\Features\FeaturesDestroyController;
use App\Http\Controllers\API\Features\FeaturesIndexController;
use App\Http\Controllers\API\Features\FeaturesShowController;
use App\Http\Controllers\API\Features\FeaturesStoreController;
use App\Http\Controllers\API\Features\FeaturesUpdateController;
use App\Http\Controllers\API\Image\ImageCriteriaController;
use App\Http\Controllers\API\Image\ImageDestroyController;
use App\Http\Controllers\API\Image\ImageIndexController;
use App\Http\Controllers\API\Image\ImageShowController;
use App\Http\Controllers\API\Image\ImageStoreController;
use App\Http\Controllers\API\Image\ImageUpdateController;
use App\Http\Controllers\API\LandingPage\LandingPageCriteriaController;
use App\Http\Controllers\API\LandingPage\LandingPageDestroyController;
use App\Http\Controllers\API\LandingPage\LandingPageIndexController;
use App\Http\Controllers\API\LandingPage\LandingPageShowController;
use App\Http\Controllers\API\LandingPage\LandingPageStoreController;
use App\Http\Controllers\API\LandingPage\LandingPageUpdateController;
use App\Http\Controllers\API\Prompt\PromptCriteriaController;
use App\Http\Controllers\API\Prompt\PromptDestroyController;
use App\Http\Controllers\API\Prompt\PromptIndexController;
use App\Http\Controllers\API\Prompt\PromptQuotaByUserController;
use App\Http\Controllers\API\Prompt\PromptShowController;
use App\Http\Controllers\API\Prompt\PromptStoreController;
use App\Http\Controllers\API\Prompt\PromptUpdateController;
use App\Http\Controllers\API\Social\SocialCriteriaController;
use App\Http\Controllers\API\Social\SocialDestroyController;
use App\Http\Controllers\API\Social\SocialIndexController;
use App\Http\Controllers\API\Social\SocialShowController;
use App\Http\Controllers\API\Social\SocialStoreController;
use App\Http\Controllers\API\Social\SocialUpdateController;
use App\Http\Controllers\API\SocialPost\SocialPostCriteriaController;
use App\Http\Controllers\API\SocialPost\SocialPostDestroyController;
use App\Http\Controllers\API\SocialPost\SocialPostIndexController;
use App\Http\Controllers\API\SocialPost\SocialPostShowController;
use App\Http\Controllers\API\SocialPost\SocialPostStoreController;
use App\Http\Controllers\API\SocialPost\SocialPostUpdateController;
use App\Http\Controllers\API\Tarif\TarifCriteriaController;
use App\Http\Controllers\API\Tarif\TarifDestroyController;
use App\Http\Controllers\API\Tarif\TarifIndexController;
use App\Http\Controllers\API\Tarif\TarifShowController;
use App\Http\Controllers\API\Tarif\TarifStoreController;
use App\Http\Controllers\API\Tarif\TarifUpdateController;
use App\Http\Controllers\API\TarifFeature\TarifFeatureCriteriaController;
use App\Http\Controllers\API\TarifFeature\TarifFeatureDestroyController;
use App\Http\Controllers\API\TarifFeature\TarifFeatureIndexController;
use App\Http\Controllers\API\TarifFeature\TarifFeatureShowController;
use App\Http\Controllers\API\TarifFeature\TarifFeatureStoreController;
use App\Http\Controllers\API\TarifFeature\TarifFeatureUpdateController;
use App\Http\Controllers\API\TarifUser\TarifUserCriteriaController;
use App\Http\Controllers\API\TarifUser\TarifUserDestroyController;
use App\Http\Controllers\API\TarifUser\TarifUserIndexController;
use App\Http\Controllers\API\TarifUser\TarifUserLatestByUserController;
use App\Http\Controllers\API\TarifUser\TarifUserShowController;
use App\Http\Controllers\API\TarifUser\TarifUserStoreController;
use App\Http\Controllers\API\TarifUser\TarifUserUpdateController;
use App\Http\Controllers\API\TypeCampaign\TypeCampaignCriteriaController;
use App\Http\Controllers\API\TypeCampaign\TypeCampaignDestroyController;
use App\Http\Controllers\API\TypeCampaign\TypeCampaignIndexController;
use App\Http\Controllers\API\TypeCampaign\TypeCampaignShowController;
use App\Http\Controllers\API\TypeCampaign\TypeCampaignStoreController;
use App\Http\Controllers\API\TypeCampaign\TypeCampaignUpdateController;
use App\Http\Controllers\API\User\UserDestroyController;
use App\Http\Controllers\API\User\UserIndexController;
use App\Http\Controllers\API\User\UserShowController;
use App\Http\Controllers\API\User\UserStoreController;
use App\Http\Controllers\API\User\UserUpdateController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Campaign\PopularCampaignController;
use App\Http\Controllers\API\Suggestion\SuggestionController;
use App\Http\Controllers\API\User\ChangePasswordController;

// Routes publiques
Route::prefix('auth')->group(function () {
    Route::post('/register', RegisterController::class);
    Route::post('/login', LoginController::class)->name('login');
    Route::post('/forgot-password', SendPasswordResetLinkController::class);
    Route::post('/reset-password', ResetPasswordController::class)->name('password.reset');
    Route::match(['get', 'post'], '/email/verify', VerifyEmailController::class)
    ->name('verification.verify');
});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/logout', LogoutController::class);
        Route::get('/me', MeController::class);
        Route::post('/refresh', RefreshTokenController::class);
        Route::post('/email/verification-notification', SendEmailVerificationController::class);
        Route::get('/email/verification-status', EmailVerificationStatusController::class)->name('verification.status');
    });

    Route::prefix('users')->group(function () {
        Route::get('/', UserIndexController::class);
        Route::post('/', UserStoreController::class);
        Route::get('/{user}', UserShowController::class);
        Route::put('/{user}', UserUpdateController::class);
        Route::delete('/{user}', UserDestroyController::class);
        Route::post('/change-password', ChangePasswordController::class);

    });

    Route::prefix('campaigns')->group(function () {
        Route::get('/', CampaignIndexController::class);
        Route::get('/search', CampaignCriteriaController::class);
        Route::post('/', CampaignStoreController::class);
        Route::get('/user/{userId}', CampaignUserController::class)->middleware('can:viewAny,App\Models\Campaign');
        Route::get('/type/{typeId}', CampaignByTypeController::class);
        Route::get('/{id}', CampaignShowController::class);
        Route::put('/{id}', CampaignUpdateController::class);
        Route::delete('/{id}',CampaignDestroyController::class);
        Route::get('/popular/content', PopularCampaignController::class);
    });

    Route::prefix('socials')->group(function () {
        Route::get('/', SocialIndexController::class);
        Route::get('/search', SocialCriteriaController::class);
        Route::get('/{id}', SocialShowController::class);
        Route::post('/', SocialStoreController::class);
        Route::put('/{id}', SocialUpdateController::class);
        Route::delete('/{id}', SocialDestroyController::class);
    });

    Route::prefix('type-campaigns')->group(function () {
        Route::get('/', TypeCampaignIndexController::class);
        Route::get('/search', TypeCampaignCriteriaController::class);
        Route::get('/{id}', TypeCampaignShowController::class);
        Route::post('/', TypeCampaignStoreController::class);
        Route::put('/{id}', TypeCampaignUpdateController::class);
        Route::delete('/{id}', TypeCampaignDestroyController::class);
    });

    Route::prefix('features')->group(function () {
        Route::get('/', FeaturesIndexController::class);
        Route::get('/search', FeaturesCriteriaController::class);
        Route::get('/{id}', FeaturesShowController::class);
        Route::post('/', FeaturesStoreController::class);
        Route::put('/{id}', FeaturesUpdateController::class);
        Route::delete('/{id}', FeaturesDestroyController::class);
    });

    Route::prefix('campaign-features')->group(function () {
        Route::get('/', CampaignFeaturesIndexController::class);
        Route::get('/search', CampaignFeaturesCriteriaController::class);
        Route::get('/{id}', CampaignFeaturesShowController::class);
        Route::post('/', CampaignFeaturesStoreController::class);
        Route::put('/{id}', CampaignFeaturesUpdateController::class);
        Route::delete('/{id}', CampaignFeaturesDestroyController::class);
    });

    Route::prefix('images')->group(function () {
        Route::get('/', ImageIndexController::class);
        Route::get('/search', ImageCriteriaController::class);
        Route::get('/{id}', ImageShowController::class);
        Route::post('/', ImageStoreController::class);
        Route::put('/{id}', ImageUpdateController::class);
        Route::delete('/{id}', ImageDestroyController::class);
    });

    Route::prefix('landing-pages')->group(function () {
        Route::get('/', LandingPageIndexController::class);
        Route::get('/search', LandingPageCriteriaController::class);
        Route::get('/{id}', LandingPageShowController::class);
        Route::post('/', LandingPageStoreController::class);
        Route::put('/{id}', LandingPageUpdateController::class);
        Route::delete('/{id}', LandingPageDestroyController::class);
    });

    Route::prefix('prompts')->group(function () {
        Route::get('/', PromptIndexController::class);
        Route::get('/search', PromptCriteriaController::class);
        Route::get('/{id}', PromptShowController::class);
        Route::post('/', PromptStoreController::class);
        Route::put('/{id}', PromptUpdateController::class);
        Route::delete('/{id}', PromptDestroyController::class);
        Route::get('/quota/user/{userId}', PromptQuotaByUserController::class)->name('prompts.quota');
    });

    Route::prefix('social-posts')->group(function () {
        Route::get('/', SocialPostIndexController::class);
        Route::get('/search', SocialPostCriteriaController::class);
        Route::get('/{id}', SocialPostShowController::class);
        Route::post('/', SocialPostStoreController::class);
        Route::put('/{id}', SocialPostUpdateController::class);
        Route::delete('/{id}', SocialPostDestroyController::class);
    });

    Route::prefix('tarifs')->group(function () {
        Route::get('/', TarifIndexController::class);
        Route::get('/search', TarifCriteriaController::class);
        Route::get('/{id}', TarifShowController::class);
        Route::post('/', TarifStoreController::class);
        Route::put('/{id}', TarifUpdateController::class);
        Route::delete('/{id}', TarifDestroyController::class);
    });

    Route::prefix('tarif-users')->group(function () {
        Route::get('/', TarifUserIndexController::class);
        Route::get('/search', TarifUserCriteriaController::class);
        Route::get('/{id}', TarifUserShowController::class);
        Route::post('/', TarifUserStoreController::class);
        Route::put('/{id}', TarifUserUpdateController::class);
        Route::delete('/{id}', TarifUserDestroyController::class);
        Route::get('/users/{user}/latest-tarif', TarifUserLatestByUserController::class)->name('tarifs.user.latest');
    });

    Route::prefix('tarif-features')->group(function () {
        Route::get('/', TarifFeatureIndexController::class);
        Route::get('/search', TarifFeatureCriteriaController::class);
        Route::get('/{id}', TarifFeatureShowController::class);
        Route::post('/', TarifFeatureStoreController::class);
        Route::put('/{id}', TarifFeatureUpdateController::class);
        Route::delete('/{id}', TarifFeatureDestroyController::class);
    });

    Route::get('/dashboard/indicators/{userId}', [DashboardController::class, 'indicators']);

    Route::get('/suggestion/{userId}', SuggestionController::class);
});
