<?php

namespace App\OpenApi\Controllers\CampaignFeatures;

/**
 * @OA\Get(
 *     path="/api/campaign-features",
 *     operationId="getCampaignFeatures",
 *     summary="Lister toutes les CampaignFeatures",
 *     description="Retourne la liste complète des CampaignFeatures. Les utilisateurs non admin ne voient que leurs propres CampaignFeatures.",
 *     tags={"CampaignFeatures"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="campaign_id",
 *         in="query",
 *         description="Filtrer par ID de campagne",
 *
 *         @OA\Schema(type="integer", example=10)
 *     ),
 *
 *     @OA\Parameter(
 *         name="feature_id",
 *         in="query",
 *         description="Filtrer par ID de feature",
 *
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des CampaignFeatures récupérée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *
 *                 @OA\Items(ref="#/components/schemas/CampaignFeaturesResource")
 *             )
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
 *         description="Accès interdit",
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
class CampaignFeaturesIndexControllerDoc {}
