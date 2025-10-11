<?php

namespace App\OpenApi\Schemas\Campaign;

/**
 * @OA\Schema(
 *     schema="PopularCampaignResourceSchema",
 *     type="object",
 *     title="Popular Campaign Resource",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Campagne populaire"),
 *     @OA\Property(property="description", type="string", example="Description de la campagne"),
 *     @OA\Property(property="type_campaign_id", type="integer", example=2),
 *     @OA\Property(property="image_path", type="string", example="https://cdn.site.com/image1.jpg"),
 *     @OA\Property(property="total_views", type="integer", example=1200),
 *     @OA\Property(property="total_likes", type="integer", example=150)
 * )
 */
class PopularCampaignResourceSchema {}
