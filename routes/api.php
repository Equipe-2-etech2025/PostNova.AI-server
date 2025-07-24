<?php

use App\Http\Controllers\API\CampaignFeaturesController;
use App\Http\Controllers\API\FeatureController;
use App\Http\Controllers\API\FeaturesController;
use App\Http\Controllers\API\ImageController;
use App\Http\Controllers\API\LandingPageController;
use App\Http\Controllers\API\PromptController;
use App\Http\Controllers\API\SocialController;
use App\Http\Controllers\API\SocialPostController;
use App\Http\Controllers\API\TarifController;
use App\Http\Controllers\API\TarifUserController;
use App\Http\Controllers\API\TypeCampaignController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\EmailVerificationController;
use App\Http\Controllers\API\Auth\PasswordResetController;
use App\Http\Controllers\API\TarifFeatureController;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CampaignController;

// Routes publiques
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login'])->name('login');
    Route::post('forgot-password', [PasswordResetController::class, 'sendResetLink']);
    Route::post('reset-password', [PasswordResetController::class, 'reset']);
    //Route de vérification publique (sans authentification)
    Route::post('email/verify', [EmailVerificationController::class, 'verify'])
        ->name('verification.verify');
});

});
// Routes publiques pour les features tarifaires
Route::get('public/tarif-features', [TarifFeatureController::class, 'index']);

// Routes protégées par authentification
Route::middleware(['auth:sanctum'])->group(function () {
    // Routes d'authentification
    Route::prefix('auth')->group(function () {
        Route::post('logout', [AuthController::class, 'logout']);
        Route::get('me', [AuthController::class, 'me']);
        Route::post('refresh', [AuthController::class, 'refresh']);

        // Envoi de l'email de vérification
        Route::post('email/verification-notification', [EmailVerificationController::class, 'send']);

        // Vérifier le statut de vérification
        Route::get('email/verify-status', [EmailVerificationController::class, 'status'])
            ->name('verification.status');
    });

    Route::prefix('campaigns')->group(function () {
        Route::get('/', [CampaignController::class, 'index']);
        Route::post('/', [CampaignController::class, 'store']);
        Route::get('/user/{userId}', [CampaignController::class, 'byUser'])
            ->middleware('can:viewAny,App\Models\Campaign');
        Route::get('/type/{typeId}', [CampaignController::class, 'byType']);
        Route::get('/{id}', [CampaignController::class, 'show']);
        Route::put('/{id}', [CampaignController::class, 'update']);
        Route::delete('/{id}', [CampaignController::class, 'destroy']);
    });

    //Route pour socials
    Route::prefix('socials')->group(function () {
        Route::get('/', [SocialController::class, 'index']);
        Route::get('/{id}', [SocialController::class, 'show']);
        Route::post('/', [SocialController::class, 'store']);
        Route::put('/{id}', [SocialController::class, 'update']);
        Route::delete('/{id}', [SocialController::class, 'destroy']);
        Route::post('/search', [SocialController::class, 'showByCriteria']);
    });

    //Route pour features
    Route::prefix('features')->group(function () {
        Route::get('/', [FeatureController::class, 'index']);
        Route::get('/{id}', [FeatureController::class, 'show']);
        Route::post('/', [FeatureController::class, 'store']);
        Route::put('/{id}', [FeatureController::class, 'update']);
        Route::delete('/{id}', [FeatureController::class, 'destroy']);
        Route::get('/search', [FeatureController::class, 'showByCriteria']);
    });

    Route::prefix('type-campaigns')->group(function () {
        Route::get('/', [TypeCampaignController::class, 'index']);
        Route::get('/{id}', [TypeCampaignController::class, 'show']);
        Route::post('/', [TypeCampaignController::class, 'store']);
        Route::put('/{id}', [TypeCampaignController::class, 'update']);
        Route::delete('/{id}', [TypeCampaignController::class, 'destroy']);
        Route::post('/search', [TypeCampaignController::class, 'showByCriteria']);
    });

    Route::prefix('features')->group(function () {
        Route::get('/', [FeaturesController::class, 'index']);
        Route::get('/{id}', [FeaturesController::class, 'show']);
        Route::post('/', [FeaturesController::class, 'store']);
        Route::put('/{id}', [FeaturesController::class, 'update']);
        Route::delete('/{id}', [FeaturesController::class, 'destroy']);
        Route::post('/search', [FeaturesController::class, 'showByCriteria']);
    });

    Route::prefix('campaign-features')->group(function () {
        Route::get('/', [CampaignFeaturesController::class, 'index']);
        Route::get('/{id}', [CampaignFeaturesController::class, 'show']);
        Route::post('/', [CampaignFeaturesController::class, 'store']);
        Route::put('/{id}', [CampaignFeaturesController::class, 'update']);
        Route::delete('/{id}', [CampaignFeaturesController::class, 'destroy']);
        Route::post('/search', [CampaignFeaturesController::class, 'showByCriteria']);
    });

    Route::prefix('images')->group(function () {
        Route::get('/', [ImageController::class, 'index']);
        Route::get('/{id}', [ImageController::class, 'show']);
        Route::post('/', [ImageController::class, 'store']);
        Route::put('/{id}', [ImageController::class, 'update']);
        Route::delete('/{id}', [ImageController::class, 'destroy']);
        Route::post('/search', [ImageController::class, 'showByCriteria']);
    });

    Route::prefix('landing-pages')->group(function () {
        Route::get('/', [LandingPageController::class, 'index']);
        Route::get('/{id}', [LandingPageController::class, 'show']);
        Route::post('/', [LandingPageController::class, 'store']);
        Route::put('/{id}', [LandingPageController::class, 'update']);
        Route::delete('/{id}', [LandingPageController::class, 'destroy']);
        Route::post('/search', [LandingPageController::class, 'showByCriteria']);
    });

    Route::prefix('prompts')->group(function () {
        Route::get('/', [PromptController::class, 'index']);
        Route::get('/{id}', [PromptController::class, 'show']);
        Route::post('/', [PromptController::class, 'store']);
        Route::put('/{id}', [PromptController::class, 'update']);
        Route::delete('/{id}', [PromptController::class, 'destroy']);
        Route::post('/search', [PromptController::class, 'showByCriteria']);
    });

    Route::prefix('social-posts')->group(function () {
        Route::get('/', [SocialPostController::class, 'index']);
        Route::get('/{id}', [SocialPostController::class, 'show']);
        Route::post('/', [SocialPostController::class, 'store']);
        Route::put('/{id}', [SocialPostController::class, 'update']);
        Route::delete('/{id}', [SocialPostController::class, 'destroy']);
        Route::post('/search', [SocialPostController::class, 'showByCriteria']);
    });

    Route::prefix('tarifs')->group(function () {
        Route::get('/', [TarifController::class, 'index']);
        Route::get('/{id}', [TarifController::class, 'show']);
        Route::post('/', [TarifController::class, 'store']);
        Route::put('/{id}', [TarifController::class, 'update']);
        Route::delete('/{id}', [TarifController::class, 'destroy']);
        Route::post('/search', [TarifController::class, 'showByCriteria']);
    });

    Route::prefix('tarif-users')->group(function () {
        Route::get('/', [TarifUserController::class, 'index']);
        Route::get('/{id}', [TarifUserController::class, 'show']);
        Route::post('/', [TarifUserController::class, 'store']);
        Route::put('/{id}', [TarifUserController::class, 'update']);
        Route::delete('/{id}', [TarifUserController::class, 'destroy']);
        Route::post('/search', [TarifUserController::class, 'showByCriteria']);
    });

    Route::prefix('tarif-features')->group(function () {
        Route::get('/', [TarifFeatureController::class, 'index']);
        Route::get('/{id}', [TarifFeatureController::class, 'show']);
        Route::post('/', [TarifFeatureController::class, 'store']);
        Route::put('/{id}', [TarifFeatureController::class, 'update']);
        Route::delete('/{id}', [TarifFeatureController::class, 'destroy']);
        Route::post('/search', [TarifFeatureController::class, 'showByCriteria']);
    });

    // Routes pour les administrateurs seulement
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', UserController::class);
    });
});
