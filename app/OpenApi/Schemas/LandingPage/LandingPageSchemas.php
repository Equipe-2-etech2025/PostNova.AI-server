<?php

namespace App\OpenApi\Schemas\LandingPage;

/**
 * @OA\Schema(
 *     schema="LandingPageResource",
 *     type="object",
 *     title="Landing Page Resource",
 *     description="Représentation d'une landing page",
 *
 *     @OA\Property(property="id", type="integer", example=7),
 *     @OA\Property(property="content", type="string", example="<h1>Bienvenue</h1>"),
 *     @OA\Property(property="campaign_id", type="integer", example=3),
 *     @OA\Property(property="is_published", type="boolean", example=true),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 15:30:00"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-25 16:00:00")
 * )
 *
 * @OA\Schema(
 *     schema="LandingPageCollection",
 *     type="object",
 *     title="Landing Page Collection",
 *     description="Collection de landing pages",
 *
 *     @OA\Property(
 *         property="success",
 *         type="boolean",
 *         example=true
 *     ),
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *
 *         @OA\Items(ref="#/components/schemas/LandingPageResource")
 *     ),
 *
 *     @OA\Property(
 *         property="meta",
 *         type="object",
 *         @OA\Property(property="total", type="integer", example=12)
 *     )
 * )
 */
class LandingPageSchemas {}
