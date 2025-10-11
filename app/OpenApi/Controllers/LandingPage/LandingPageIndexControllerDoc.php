<?php

namespace App\OpenApi\Controllers\LandingPage;

/**
 * @OA\Get(
 *     path="/api/landing-pages",
 *     summary="Liste des landing pages",
 *     description="Retourne la liste des landing pages, filtrable par `campaign_id`.",
 *     tags={"LandingPages"},
 *
 *     @OA\Parameter(
 *         name="campaign_id",
 *         in="query",
 *         description="Filtrer par ID de campagne",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=12)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des landing pages",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="array",
 *
 *                 @OA\Items(ref="#/components/schemas/LandingPageResource")
 *             ),
 *
 *             @OA\Property(property="meta", type="object",
 *                 @OA\Property(property="total", type="integer", example=5)
 *             )
 *         )
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
 *         response=404,
 *         description="Ressource non trouvée",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
class LandingPageIndexControllerDoc {}
