<?php

namespace App\OpenApi\Schemas\TarifFeature;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TarifFeatureResource",
 *     title="Tarif Feature",
 *     description="Représentation d'une fonctionnalité liée à un tarif",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="tarif_id", type="integer", example=5),
 *     @OA\Property(property="name", type="string", example="Support Premium"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 12:30"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-25 12:30")
 * )
 *
 * @OA\Schema(
 *     schema="TarifFeatureCollection",
 *     title="Tarif Feature Collection",
 *     type="object",
 *
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *
 *         @OA\Items(ref="#/components/schemas/TarifFeatureResource")
 *     )
 * )
 */
class TarifFeatureResource {}
