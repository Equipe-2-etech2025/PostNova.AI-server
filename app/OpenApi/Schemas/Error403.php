<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Error403",
 *     type="object",
 *     title="Accès refusé",
 *     description="Permissions insuffisantes",
 *
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="Accès non autorisé")
 * )
 */
class Error403 {}
