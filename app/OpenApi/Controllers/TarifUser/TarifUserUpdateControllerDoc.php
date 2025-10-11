<?php

namespace App\OpenApi\Controllers\TarifUser;

use OpenApi\Annotations as OA;

/**
 * @OA\Put(
 *     path="/api/tarif-users/{id}",
 *     summary="Mettre à jour un TarifUser",
 *     description="Met à jour les informations d'un TarifUser existant",
 *     tags={"TarifUsers"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du TarifUser à mettre à jour",
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="tarif_id", type="integer", example=2),
 *             @OA\Property(property="expired_at", type="string", format="date-time", example="2025-11-25 12:00")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="TarifUser mis à jour avec succès",
 *
 *         @OA\JsonContent(ref="#/components/schemas/TarifUserResource")
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
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Le tarif_id est requis"))
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Une erreur est survenue lors de la mise à jour"))
 *     )
 * )
 */
class TarifUserUpdateControllerDoc {}
