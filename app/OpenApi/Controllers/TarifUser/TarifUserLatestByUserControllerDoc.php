<?php

namespace App\OpenApi\Controllers\TarifUser;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/tarif-users/latest/{userId}",
 *     summary="Récupérer le dernier TarifUser pour un utilisateur",
 *     description="Retourne le dernier TarifUser actif pour l'utilisateur spécifié. Si aucun tarif n'est trouvé, renvoie null.",
 *     tags={"TarifUsers"},
 *
 *     @OA\Parameter(
 *         name="userId",
 *         in="path",
 *         required=true,
 *         description="ID de l'utilisateur",
 *
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Dernier TarifUser récupéré avec succès",
 *
 *         @OA\JsonContent(
 *             oneOf={
 *
 *                 @OA\Schema(ref="#/components/schemas/TarifUserResource"),
 *                 @OA\Schema(
 *                     type="object",
 *
 *                     @OA\Property(property="success", type="boolean", example=true),
 *                     @OA\Property(property="data", type="null", example=null),
 *                     @OA\Property(property="message", type="string", example="Aucun tarif trouvé pour cet utilisateur.")
 *                 )
 *             }
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
 *         response=404,
 *         description="Utilisateur non trouvé",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Not Found"))
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Une erreur est survenue lors de la récupération du dernier tarif"))
 *     )
 * )
 */
class TarifUserLatestByUserControllerDoc {}
