<?php

namespace App\OpenApi\Controllers\CampaignFeatures;

/**
 * @OA\Put(
 *     path="/api/campaign-features/{id}",
 *     summary="Mettre à jour une CampaignFeature",
 *     description="Met à jour les informations d'une CampaignFeature existante.",
 *     tags={"CampaignFeatures"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la CampaignFeature à mettre à jour",
 *
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *         description="Données à mettre à jour pour la CampaignFeature",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="campaign_id", type="integer", example=10),
 *             @OA\Property(property="feature_id", type="integer", example=3)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="CampaignFeature mise à jour avec succès",
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
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Error500"
 *         )
 *     )
 * )
 */
class CampaignFeaturesUpdateControllerDoc {}
