<?php

namespace App\OpenApi\Schemas\Prompt;

/**
 * @OA\Schema(
 *     schema="PromptResource",
 *     type="object",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="content", type="string", example="Créer un prompt pour campagne X"),
 *     @OA\Property(property="campaign_id", type="integer", example=5),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 15:30:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-25 15:30:00")
 * )
 */
class PromptResource {}
