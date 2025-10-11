<?php

namespace App\OpenApi\Controllers\LandingPage;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/landing-pages/search",
 *     summary="Lister les landing pages selon des critères",
 *     description="Retourne la liste des landing pages filtrées selon les critères fournis. Les utilisateurs non-admin ne voient que leurs propres landing pages.",
 *     tags={"LandingPages"},
 *
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         description="Filtrer par ID utilisateur (uniquement admin)",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *
 *     @OA\Parameter(
 *         name="campaign_id",
 *         in="query",
 *         description="Filtrer par ID campagne",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=12)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des landing pages",
 *
 *         @OA\JsonContent(ref="#/components/schemas/LandingPageCollection")
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur inattendue",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Erreur interne du serveur lors de la récupération des landing pages.")
 *         )
 *     )
 * )
 */
class LandingPageCriteriaControllerDoc {}
