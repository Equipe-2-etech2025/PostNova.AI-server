<?php

namespace App\OpenApi\Controllers\Social;

/**
 * @OA\Post(
 *     path="/api/socials",
 *     summary="Créer un post social",
 *     description="Crée un nouveau post social.",
 *     tags={"Socials"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="name", type="string", example="Nom du post social")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Post social créé avec succès",
 *
 *         @OA\JsonContent(ref="#/components/schemas/SocialResource")
 *     ),
 *
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=403, description="Accès refusé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=422, description="Validation échouée", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=500, description="Erreur interne du serveur", @OA\JsonContent(ref="#/components/schemas/ErrorResponse"))
 * )
 */
class SocialStoreControllerDoc {}
