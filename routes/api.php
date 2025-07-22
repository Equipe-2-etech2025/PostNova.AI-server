<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Auth\AuthController;
use App\Http\Controllers\API\Auth\EmailVerificationController;
use App\Http\Controllers\API\Auth\PasswordResetController;
use App\Http\Controllers\API\TarifFeatureController;
use App\Http\Controllers\API\UserController;

// Routes publiques
Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::post('forgot-password', [PasswordResetController::class, 'sendResetLink']);
    Route::post('reset-password', [PasswordResetController::class, 'reset']);
});

// Routes publiques pour les features tarifaires
Route::get('public/tarif-features', [TarifFeatureController::class, 'index']);

// Routes protégées par authentification
Route::middleware('auth:sanctum')->group(function () {

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
        
            Route::get('/email/verify-status',[EmailVerificationController::class],'status')
            ->name('verification.status');
    });

    // Routes pour les utilisateurs authentifiés
    Route::apiResource('tarif-features', TarifFeatureController::class);

    // Routes pour les administrateurs seulement
    Route::middleware('role:admin')->group(function () {
        Route::apiResource('users', UserController::class);
    });
});
