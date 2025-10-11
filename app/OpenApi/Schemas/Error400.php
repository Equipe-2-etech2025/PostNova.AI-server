<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Error400",
 *     type="object",
 *     title="Requête incorrecte",
 *     description="Les paramètres de la requête sont invalides",
 *
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="Paramètres de requête invalides")
 * )
 */
class Error400 {}
