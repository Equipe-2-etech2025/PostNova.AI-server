<?php

namespace App\OpenApi\Controllers\Campaign;

/**
 * @OA\Get(
 *     path="/api/campaigns/search",
 *     summary="Lister les campagnes selon des critères",
 *     description="Retourne les campagnes filtrées selon les critères passés en query params.",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="status",
 *         in="query",
 *         required=false,
 *         description="Filtrer par statut de campagne",
 *
 *         @OA\Schema(type="string", example="active")
 *     ),
 *
 *     @OA\Parameter(
 *         name="type_campaign_id",
 *         in="query",
 *         required=false,
 *         description="Filtrer par type de campagne",
 *
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *
 *     @OA\Parameter(
 *         name="is_published",
 *         in="query",
 *         required=false,
 *         description="Filtrer par publication",
 *
 *         @OA\Schema(type="boolean", example=true)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Campagnes récupérées avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *
 *                 @OA\Items(ref="#/components/schemas/CampaignResource")
 *             ),
 *
 *             @OA\Property(
 *                 property="meta",
 *                 type="object",
 *                 @OA\Property(property="total", type="integer", example=5)
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Requête invalide",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "La requête est invalide ou mal formée",
 *                 "errors": {}
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Vous devez être connecté pour accéder à cette ressource",
 *                 "errors": {}
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès interdit",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Vous n'avez pas la permission de consulter ces campagnes",
 *                 "errors": {}
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Une erreur de serveur est survenue"
 *             }
 *         )
 *     )
 * )
 */
class CampaignCriteriaControllerDoc {}
