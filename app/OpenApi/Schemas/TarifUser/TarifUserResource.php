<?php

namespace App\OpenApi\Schemas\TarifUser;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TarifUserResource",
 *     type="object",
 *     title="TarifUser",
 *     description="Représentation d'un TarifUser",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="tarif_id", type="integer", example=2),
 *     @OA\Property(property="user_id", type="integer", example=5),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 12:00"),
 *     @OA\Property(property="expired_at", type="string", format="date-time", example="2025-10-25 12:00"),
 *     @OA\Property(
 *         property="tarif",
 *         type="object",
 *         @OA\Property(property="id", type="integer", example=2),
 *         @OA\Property(property="name", type="string", example="Premium"),
 *         @OA\Property(property="amount", type="number", format="float", example=99.99),
 *         @OA\Property(property="max_limit", type="integer", example=100)
 *     )
 * )
 */
class TarifUserResource {}
