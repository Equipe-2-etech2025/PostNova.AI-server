<?php

namespace App\OpenApi\Controllers\TypeCampaign;

use OpenApi\Annotations as OA;

/**
 * @OA\Put(
 *     path="/api/type-campaigns/{id}",
 *     summary="Mettre à jour un TypeCampaign",
 *     description="Met à jour un TypeCampaign existant.",
 *     tags={"TypeCampaigns"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du TypeCampaign à mettre à jour",
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="name", type="string", example="Nouvelle campagne marketing")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="TypeCampaign mis à jour",
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
 *         response=422,
 *         description="Données invalides",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Le nom est requis"))
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
class TypeCampaignUpdateControllerDoc {}
