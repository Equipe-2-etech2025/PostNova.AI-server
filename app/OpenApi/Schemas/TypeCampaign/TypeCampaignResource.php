<?php

namespace App\OpenApi\Schemas\TypeCampaign;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="TypeCampaignResource",
 *     type="object",
 *     title="TypeCampaignResource",
 *     description="Représentation d'un TypeCampaign",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Marketing"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 14:30"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-25 14:30")
 * )
 */
class TypeCampaignResource {}
