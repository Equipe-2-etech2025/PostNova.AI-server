<?php

namespace App\OpenApi\Controllers\Campaign;

/**
 * @OA\Get(
 *     path="/api/campaigns/popular/content",
 *     summary="Récupérer les campagnes populaires",
 *     description="Retourne la liste des campagnes populaires avec leurs statistiques",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des campagnes populaires récupérée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *
 *                 @OA\Items(ref="#/components/schemas/PopularCampaignResourceSchema")
 *             ),
 *
 *             @OA\Property(
 *                 property="totals",
 *                 type="object",
 *                 @OA\Property(property="total_views", type="integer", example=5000),
 *                 @OA\Property(property="total_likes", type="integer", example=350)
 *             )
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
 *         description="Accès interdit",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error403")
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error500")
 *     )
 * )
 */
class PopularCampaignControllerDoc {}
