<?php

namespace App\OpenApi\Controllers\Social;

/**
 * @OA\Get(
 *     path="/api/socials/{id}",
 *     summary="Afficher un post social",
 *     description="Retourne les détails d'un post social spécifique.",
 *     tags={"Socials"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID du post social",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=7)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Détails du post social",
 *
 *         @OA\JsonContent(ref="#/components/schemas/SocialResource")
 *     ),
 *
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=403, description="Accès refusé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=404, description="Post social non trouvé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=500, description="Erreur interne du serveur", @OA\JsonContent(ref="#/components/schemas/ErrorResponse"))
 * )
 */
class SocialShowControllerDoc {}
