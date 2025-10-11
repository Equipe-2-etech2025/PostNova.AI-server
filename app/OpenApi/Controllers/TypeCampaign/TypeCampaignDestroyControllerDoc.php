<?php

namespace App\OpenApi\Controllers\TypeCampaign;

use OpenApi\Annotations as OA;

/**
 * @OA\Delete(
 *     path="/api/type-campaigns/{id}",
 *     summary="Supprime un TypeCampaign",
 *     description="Supprime un TypeCampaign existant par son ID. Nécessite les droits de suppression.",
 *     tags={"TypeCampaigns"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du TypeCampaign à supprimer",
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="TypeCampaign supprimé avec succès",
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
 *
 *             @OA\Property(property="message", type="string", example="Unauthorized")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Forbidden")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="TypeCampaign non trouvé",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Not Found")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Une erreur est survenue lors de la suppression du TypeCampaign")
 *         )
 *     )
 * )
 */
class TypeCampaignDestroyControllerDoc {}
