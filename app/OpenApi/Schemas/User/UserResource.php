<?php

namespace App\OpenApi\Schemas\User;

use OpenApi\Annotations as OA;

/**
 * @OA\Schema(
 *     schema="UserResource",
 *     type="object",
 *     title="User Resource",
 *     description="Représentation d'un utilisateur",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="name", type="string", example="John Doe"),
 *     @OA\Property(property="email", type="string", example="john@example.com"),
 *     @OA\Property(property="role", type="string", example="admin"),
 *     @OA\Property(property="email_verified_at", type="string", format="date-time", example="2025-09-25T19:00:00Z"),
 *     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-01T12:00:00Z"),
 *     @OA\Property(property="updated_at", type="string", format="date-time", example="2025-09-20T10:00:00Z")
 * )
 */
class UserResource {}
