<?php

namespace App\OpenApi\Controllers\Campaign;

/**
 * @OA\Get(
 *     path="/api/campaigns/type/{typeId}",
 *     summary="Lister les campagnes par type",
 *     description="Retourne les campagnes correspondant à un type spécifique. Les campagnes sont filtrées selon les permissions de l'utilisateur connecté.",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="typeId",
 *         in="path",
 *         required=true,
 *         description="ID du type de campagne",
 *
 *         @OA\Schema(type="integer", example=2)
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
 *                 @OA\Property(property="total", type="integer", example=3)
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
 *         response=400,
 *         description="Type de campagne introuvable",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error400")
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
class CampaignByTypeControllerDoc {}
