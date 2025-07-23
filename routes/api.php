<?php

use App\Http\Controllers\API\CampaignFeaturesController;
use App\Http\Controllers\API\FeatureController;
use App\Http\Controllers\API\FeaturesController;
use App\Http\Controllers\API\SocialController;
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

        // Vérification d'email
        Route::post('email/verification-notification', [EmailVerificationController::class, 'send']);
        Route::post('email/verify/{id}/{hash}', [EmailVerificationController::class, 'verify'])
            ->middleware('signed')
            ->name('verification.verify');
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

    // Routes pour les administrateurs seulement
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', UserController::class);
    });
});
