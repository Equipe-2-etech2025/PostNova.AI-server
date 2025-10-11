<?php

namespace App\OpenApi\Controllers\TarifFeature;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/tarif-features/{id}",
 *     summary="Récupérer un TarifFeature par ID",
 *     description="Retourne les détails d'une caractéristique de tarif spécifique.",
 *     tags={"Tarif Features"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID du TarifFeature",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Détails du TarifFeature",
 *
 *         @OA\JsonContent(ref="#/components/schemas/TarifFeatureResource")
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="TarifFeature non trouvé",
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
class TarifFeatureShowControllerDoc {}
