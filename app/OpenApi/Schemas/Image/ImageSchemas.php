<?php

namespace App\OpenApi\Schemas\Image;

/**
 * @OA\Schema(
 *     schema="ImageResource",
 *     type="object",
 *     title="Image Resource",
 *     description="Représentation d'une image",
 *
 *     @OA\Property(property="id", type="integer", example=101),
 *     @OA\Property(property="path", type="string", example="/uploads/images/example.png"),
 *     @OA\Property(property="is_published", type="boolean", example=true),
 *     @OA\Property(property="campaign_id", type="integer", nullable=true, example=5),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25T15:30:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-25T15:45:00Z"),
 *     @OA\Property(property="prompt", type="string", nullable=true, example="Image générée à partir d'une IA")
 * )
 *
 * @OA\Schema(
 *     schema="ImageCollection",
 *     type="object",
 *     title="Image Collection",
 *     description="Collection d'images avec métadonnées",
 *
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *
 *         @OA\Items(ref="#/components/schemas/ImageResource")
 *     ),
 *
 *     @OA\Property(
 *         property="meta",
 *         type="object",
 *         @OA\Property(property="total", type="integer", example=10)
 *     )
 * )
 */
class ImageSchemas {}
