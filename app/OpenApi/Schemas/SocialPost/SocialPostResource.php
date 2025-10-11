<?php

namespace App\OpenApi\Schemas\SocialPost;

/**
 * @OA\Schema(
 *     schema="SocialPostResource",
 *     type="object",
 *     title="SocialPost Resource",
 *     description="Représente un post social",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="content", type="string", example="Contenu du post social"),
 *     @OA\Property(property="is_published", type="boolean", example=true),
 *     @OA\Property(property="social_id", type="integer", example=2),
 *     @OA\Property(property="campaign_id", type="integer", example=3),
 *     @OA\Property(property="prompt_id", type="integer", example=4),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 12:34:56"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-25 12:34:56"),
 *     @OA\Property(
 *         property="social",
 *         type="object",
 *         nullable=true,
 *         description="Relation chargée du social",
 *         example={"id":2, "name":"Nom du social"}
 *     ),
 *     @OA\Property(
 *         property="campaign",
 *         type="object",
 *         nullable=true,
 *         description="Relation chargée de la campagne",
 *         example={"id":3, "title":"Nom de la campagne"}
 *     )
 * )
 */
class SocialPostResource {}
