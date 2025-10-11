<?php

namespace App\OpenApi\Controllers\CampaignInteraction;

/**
 * @OA\Get(
 *     path="/api/campaign-interactions/search",
 *     summary="Lister les interactions d'une campagne selon des critères",
 *     description="Récupère une liste des interactions (vues, likes, partages, etc.) filtrées par critères fournis en query params.",
 *     tags={"Campaign Interactions"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="campaign_id",
 *         in="query",
 *         description="Filtrer par identifiant de la campagne",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=12)
 *     ),
 *
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         description="Filtrer par identifiant de l’utilisateur",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=45)
 *     ),
 *
 *     @OA\Parameter(
 *         name="type",
 *         in="query",
 *         description="Type d’interaction (view, like, share…)",
 *         required=false,
 *
 *         @OA\Schema(type="string", example="like")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des interactions trouvées selon les critères",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *
 *                 @OA\Items(ref="#/components/schemas/CampaignInteractionResource")
 *             ),
 *
 *             @OA\Property(
 *                 property="meta",
 *                 type="object",
 *                 @OA\Property(property="total_interactions", type="integer", example=50),
 *                 @OA\Property(property="total_views", type="integer", example=1200),
 *                 @OA\Property(property="total_likes", type="integer", example=300),
 *                 @OA\Property(property="total_shares", type="integer", example=75)
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Requête invalide",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Error400"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Error401"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Error403"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Error500"
 *         )
 *     )
 * )
 */
class CampaignInteractionCriteriaControllerDoc {}
