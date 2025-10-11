<?php

namespace App\OpenApi\Controllers\Auth;

/**
 * @OA\Post(
 *     path="/api/auth/refresh-token",
 *     summary="Rafraîchir le token",
 *     tags={"Authentication"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Token rafraîchi",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Token rafraîchi"),
 *             @OA\Property(property="data", type="object")
 *         )
 *     ),
 *
 *     @OA\Response(response=500, description="Erreur serveur", @OA\JsonContent(ref="#/components/schemas/Error500"))
 * )
 */
class RefreshTokenControllerDoc {}
