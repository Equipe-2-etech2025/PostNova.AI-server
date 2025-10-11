<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Error401",
 *     type="object",
 *     title="Non authentifié",
 *     description="Authentification requise ou token invalide",
 *
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="Authentification requise")
 * )
 */
class Error401 {}
