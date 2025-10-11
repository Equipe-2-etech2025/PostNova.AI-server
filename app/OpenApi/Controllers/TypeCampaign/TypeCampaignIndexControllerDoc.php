<?php

namespace App\OpenApi\Controllers\TypeCampaign;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/type-campaigns",
 *     summary="Liste tous les TypeCampaign",
 *     description="Récupère tous les TypeCampaign pour les utilisateurs autorisés.",
 *     tags={"TypeCampaigns"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des TypeCampaign",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *
 *                 @OA\Items(ref="#/components/schemas/TypeCampaignResource")
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthorized"))
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Forbidden"))
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Une erreur est survenue"))
 *     )
 * )
 */
class TypeCampaignIndexControllerDoc {}
