<?php

namespace App\OpenApi\Schemas\Campaign;

/**
 * @OA\Schema(
 *     schema="CampaignResource",
 *     type="object",
 *     title="Campaign Resource",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="Campagne de test"),
 *     @OA\Property(property="user_id", type="integer", example=10),
 *     @OA\Property(property="type_campaign_id", type="integer", example=3),
 *     @OA\Property(
 *         property="status",
 *         type="object",
 *         @OA\Property(property="value", type="string", example="active"),
 *         @OA\Property(property="label", type="string", example="Active")
 *     ),
 *     @OA\Property(property="is_published", type="boolean", example=true),
 *     @OA\Property(property="description", type="string", example="Description de la campagne"),
 *     @OA\Property(
 *         property="user",
 *         type="object",
 *         nullable=true,
 *         @OA\Property(property="id", type="integer", example=10),
 *         @OA\Property(property="name", type="string", example="Jean Dupont")
 *     ),
 *     @OA\Property(property="user_has_liked", type="boolean", example=true),
 *     @OA\Property(property="user_has_shared", type="boolean", example=false),
 *     @OA\Property(
 *         property="type",
 *         type="object",
 *         nullable=true,
 *         @OA\Property(property="id", type="integer", example=2),
 *         @OA\Property(property="name", type="string", example="Campagne Marketing")
 *     ),
 *     @OA\Property(
 *         property="dates",
 *         type="object",
 *         @OA\Property(property="created_at", type="string", example="2025-09-21 12:00"),
 *         @OA\Property(property="updated_at", type="string", example="2025-09-21 12:30"),
 *         @OA\Property(property="time_ago", type="string", example="il y a 2 heures")
 *     ),
 *     @OA\Property(property="images_count", type="integer", example=3),
 *     @OA\Property(property="landing_pages_count", type="integer", example=1),
 *     @OA\Property(property="social_posts_count", type="integer", example=5),
 *     @OA\Property(property="total_views", type="integer", example=1000),
 *     @OA\Property(property="total_likes", type="integer", example=50),
 *     @OA\Property(property="total_shares", type="integer", example=20),
 *     @OA\Property(
 *         property="images",
 *         type="array",
 *
 *         @OA\Items(
 *             type="object",
 *
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="url", type="string", example="https://cdn.site.com/image1.jpg"),
 *             @OA\Property(property="alt", type="string", example="Image de la campagne"),
 *             @OA\Property(property="is_published", type="boolean", example=true),
 *             @OA\Property(property="created_at", type="string", example="2025-09-21 12:15")
 *         )
 *     )
 * )
 */
class CampaignResourceSchema {}
