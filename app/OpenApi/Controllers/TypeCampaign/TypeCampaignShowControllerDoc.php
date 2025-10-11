<?php

namespace App\OpenApi\Controllers\TypeCampaign;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/type-campaigns/{id}",
 *     summary="Afficher un TypeCampaign",
 *     description="Récupère un TypeCampaign par son ID.",
 *     tags={"TypeCampaigns"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du TypeCampaign",
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="TypeCampaign trouvé",
 *
 *         @OA\JsonContent(ref="#/components/schemas/TypeCampaignResource")
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
 *         response=404,
 *         description="TypeCampaign non trouvé",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Not Found"))
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
class TypeCampaignShowControllerDoc {}
