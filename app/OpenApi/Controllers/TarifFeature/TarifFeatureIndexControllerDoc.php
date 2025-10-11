<?php

namespace App\OpenApi\Controllers\TarifFeature;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/tarif-features",
 *     summary="Récupérer tous les TarifFeatures",
 *     description="Retourne la liste complète des caractéristiques de tarifs.",
 *     tags={"Tarif Features"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste complète des TarifFeatures",
 *
 *         @OA\JsonContent(ref="#/components/schemas/TarifFeatureCollection")
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthorized"))
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
class TarifFeatureIndexControllerDoc {}
