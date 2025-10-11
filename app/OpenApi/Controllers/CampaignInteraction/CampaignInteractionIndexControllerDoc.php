<?php

namespace App\OpenApi\Controllers\CampaignInteraction;

/**
 * @OA\Get(
 *     path="/api/campaign-interactions",
 *     summary="Lister toutes les interactions",
 *     description="Retourne la liste complète des interactions disponibles.",
 *     tags={"Campaign Interactions"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des interactions récupérée avec succès",
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
 *                 @OA\Property(property="total", type="integer", example=120)
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
class CampaignInteractionIndexControllerDoc {}
