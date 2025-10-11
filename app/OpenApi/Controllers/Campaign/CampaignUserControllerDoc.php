<?php

namespace App\OpenApi\Controllers\Campaign;

/**
 * @OA\Get(
 *     path="/api/campaigns/user/{userId}",
 *     summary="Récupérer les campagnes d'un utilisateur",
 *     description="Retourne la liste des campagnes appartenant à un utilisateur spécifique",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="userId",
 *         in="path",
 *         required=true,
 *         description="ID de l'utilisateur",
 *
 *         @OA\Schema(type="integer", example=10)
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
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error401"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès interdit",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error403"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Utilisateur non trouvé",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error400"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error500"
 *         )
 *     )
 * )
 */
class CampaignUserControllerDoc {}
