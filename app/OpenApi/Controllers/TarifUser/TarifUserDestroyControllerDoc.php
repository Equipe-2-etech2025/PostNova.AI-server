<?php

namespace App\OpenApi\Controllers\TarifUser;

use OpenApi\Annotations as OA;

/**
 * @OA\Delete(
 *     path="/api/tarif-users/{id}",
 *     summary="Supprimer un TarifUser",
 *     description="Supprime un TarifUser par ID",
 *     tags={"TarifUsers"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du TarifUser à supprimer",
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="TarifUser supprimé avec succès",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Supprimé avec succès"))
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
 *         description="TarifUser non trouvé",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Not Found"))
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Une erreur est survenue lors de la suppression"))
 *     )
 * )
 */
class TarifUserDestroyControllerDoc {}
