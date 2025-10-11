<?php

namespace App\OpenApi\Schemas\Feature;

/**
 * @OA\Schema(
 *     schema="FeatureResource",
 *     type="object",
 *     title="Feature Resource",
 *     description="Représentation d'une fonctionnalité (Feature)",
 *
 *     @OA\Property(property="id", type="integer", example=12),
 *     @OA\Property(property="name", type="string", example="Nouvelle Fonctionnalité"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 15:30")
 * )
 *
 * @OA\Schema(
 *     schema="FeatureCollection",
 *     type="object",
 *     title="Feature Collection",
 *     description="Collection de fonctionnalités",
 *
 *     @OA\Property(
 *         property="data",
 *         type="array",
 *
 *         @OA\Items(ref="#/components/schemas/FeatureResource")
 *     )
 * )
 */
class FeatureSchemas {}
