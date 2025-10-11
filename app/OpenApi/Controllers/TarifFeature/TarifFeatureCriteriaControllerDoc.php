<?php

namespace App\OpenApi\Controllers\TarifFeature;

use OpenApi\Annotations as OA;

class TarifFeatureCriteriaControllerDoc
{
    /**
     * @OA\Get(
     *     path="/api/tarif-features",
     *     summary="Lister les fonctionnalités de tarif selon des critères",
     *     description="Retourne une collection de fonctionnalités de tarif filtrées par critères (par ex: user_id, tarif_id, etc.).",
     *     tags={"TarifFeature"},
     *
     *     @OA\Parameter(
     *         name="tarif_id",
     *         in="query",
     *         required=false,
     *         description="Filtrer par identifiant du tarif",
     *
     *         @OA\Schema(type="integer", example=5)
     *     ),
     *
     *     @OA\Parameter(
     *         name="name",
     *         in="query",
     *         required=false,
     *         description="Filtrer par nom de fonctionnalité",
     *
     *         @OA\Schema(type="string", example="Support Premium")
     *     ),
     *
     *     @OA\Response(
     *         response=200,
     *         description="Collection de fonctionnalités de tarif",
     *
     *         @OA\JsonContent(ref="#/components/schemas/TarifFeatureCollection")
     *     ),
     *
     *     @OA\Response(
     *         response=401,
     *         description="Non authentifié"
     *     ),
     *     @OA\Response(
     *         response=403,
     *         description="Accès refusé"
     *     )
     * )
     */
}
