<?php

namespace App\OpenApi\Controllers\CampaignInteraction;

/**
 * @OA\Get(
 *     path="/api/campaign-interactions/{campaignId}/stats",
 *     summary="Récupérer les statistiques d'interactions d'une campagne",
 *     description="Retourne le nombre total de likes, vues et partages pour une campagne spécifique.",
 *     tags={"Campaign Interactions"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="campaignId",
 *         in="path",
 *         description="Identifiant de la campagne",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=12)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Statistiques récupérées avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "likes": 120,
 *                 "views": 1500,
 *                 "shares": 45
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error401")
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error403")
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error500")
 *     )
 * )
 */
class CampaignInteractionStatsControllerDoc {}
