<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Error500",
 *     type="object",
 *     title="Erreur serveur",
 *     description="Erreur interne du serveur",
 *
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="Erreur interne du serveur")
 * )
 */
class Error500 {}
