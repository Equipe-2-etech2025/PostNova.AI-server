<?php

namespace App\OpenApi\Controllers\Social;

/**
 * @OA\Get(
 *     path="/api/socials",
 *     summary="Lister tous les posts sociaux",
 *     description="Retourne tous les posts sociaux.",
 *     tags={"Socials"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des posts sociaux",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/SocialResource"))
 *         )
 *     ),
 *
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=403, description="Accès refusé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=500, description="Erreur interne du serveur", @OA\JsonContent(ref="#/components/schemas/ErrorResponse"))
 * )
 */
class SocialIndexControllerDoc {}
