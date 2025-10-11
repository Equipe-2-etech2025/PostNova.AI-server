<?php

namespace App\OpenApi\Controllers\CampaignFeatures;

/**
 * @OA\Post(
 *     path="/api/campaign-features",
 *     operationId="createCampaignFeature",
 *     summary="Créer une nouvelle CampaignFeature",
 *     description="Crée une nouvelle CampaignFeature pour une campagne spécifique.",
 *     tags={"CampaignFeatures"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\RequestBody(
 *         required=true,
 *         description="Données nécessaires pour créer une CampaignFeature",
 *
 *         @OA\JsonContent(
 *             required={"campaign_id", "feature_id"},
 *
 *             @OA\Property(property="campaign_id", type="integer", example=10),
 *             @OA\Property(property="feature_id", type="integer", example=3)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="CampaignFeature créée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(
 *                 property="data",
 *                 ref="#/components/schemas/CampaignFeaturesResource"
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
 *         description="Accès interdit",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Error403"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Les données fournies sont invalides",
 *                 "errors": {
 *                     "campaign_id": {"La campagne spécifiée est introuvable."},
 *                     "feature_id": {"La fonctionnalité sélectionnée est invalide."}
 *                 }
 *             }
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
class CampaignFeaturesStoreControllerDoc {}
