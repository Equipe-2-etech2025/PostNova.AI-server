<?php

namespace App\OpenApi\Controllers\Auth;

/**
 * @OA\Post(
 *     path="/api/auth/logout",
 *     summary="Déconnexion utilisateur",
 *     tags={"Authentication"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Déconnexion réussie",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Déconnexion réussie.")
 *         )
 *     )
 * )
 */
class LogoutControllerDoc {}
