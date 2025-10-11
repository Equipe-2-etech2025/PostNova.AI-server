<?php

namespace App\OpenApi\Controllers\Social;

/**
 * @OA\Get(
 *     path="/api/socials/search",
 *     summary="Lister les posts sociaux selon des critères",
 *     description="Retourne la liste des posts sociaux selon les critères fournis pour l'utilisateur connecté. Les admins voient tous les posts.",
 *     tags={"Socials"},
 *
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         description="Filtrer par ID utilisateur (automatiquement ajouté si non admin)",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=12)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des posts sociaux",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="data", type="array",
 *
 *                 @OA\Items(ref="#/components/schemas/SocialResource")
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=403, description="Accès refusé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=500, description="Erreur interne du serveur", @OA\JsonContent(ref="#/components/schemas/ErrorResponse"))
 * )
 */
class SocialCriteriaControllerDoc {}
