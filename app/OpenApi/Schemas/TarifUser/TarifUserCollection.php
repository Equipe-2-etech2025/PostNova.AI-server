<?php

namespace App\OpenApi\Schemas\TarifUser;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TarifUserCollection",
 *     type="object",
 *
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *
 *         @OA\Items(ref="#/components/schemas/TarifUserResource")
 *     )
 * )
 */
class TarifUserCollection {}
