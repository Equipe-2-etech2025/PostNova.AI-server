<?php

namespace App\OpenApi\Controllers\CampaignFeatures;

/**
 * @OA\Delete(
 *     path="/api/campaign-features/{id}",
 *     summary="Supprimer une CampaignFeature",
 *     description="Supprime une CampaignFeature par son ID. Seul l'utilisateur autorisé peut effectuer cette action.",
 *     tags={"CampaignFeatures"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la CampaignFeature à supprimer",
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="CampaignFeature supprimée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="message", type="string", example="Supprimé avec succès.")
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
 *         response=400,
 *         description="CampaignFeature introuvable",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Error400"
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
class CampaignFeaturesDestroyControllerDoc {}
