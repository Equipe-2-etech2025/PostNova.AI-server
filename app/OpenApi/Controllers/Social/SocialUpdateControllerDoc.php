<?php

namespace App\OpenApi\Controllers\Social;

/**
 * @OA\Put(
 *     path="/api/socials/{id}",
 *     summary="Mettre à jour un post social",
 *     description="Met à jour un post social existant.",
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
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="name", type="string", example="Nom du post social mis à jour")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Post social mis à jour",
 *
 *         @OA\JsonContent(ref="#/components/schemas/SocialResource")
 *     ),
 *
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=403, description="Accès refusé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=404, description="Post social non trouvé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=422, description="Validation échouée", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=500, description="Erreur interne du serveur", @OA\JsonContent(ref="#/components/schemas/ErrorResponse"))
 * )
 */
class SocialUpdateControllerDoc {}
