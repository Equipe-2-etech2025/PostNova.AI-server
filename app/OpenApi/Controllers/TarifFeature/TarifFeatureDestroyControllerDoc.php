<?php

namespace App\OpenApi\Controllers\TarifFeature;

use OpenApi\Annotations as OA;

/**
 * @OA\Delete(
 *     path="/api/tarif-features/{id}",
 *     summary="Supprimer une caractéristique de tarif",
 *     description="Supprime une feature existante par son ID.",
 *     tags={"Tarif Features"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID du TarifFeature à supprimer",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Feature supprimée avec succès",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Supprimé avec succès."))
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Feature non trouvée",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="TarifFeature not found"))
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Forbidden"))
 *     )
 * )
 */
class TarifFeatureDestroyControllerDoc {}
