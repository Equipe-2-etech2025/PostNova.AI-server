<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="Error422",
 *     type="object",
 *     title="Erreur de validation",
 *     description="Données de validation invalides",
 *
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="Les données fournies sont invalides"),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *         example={
 *             "email": {"Le champ email est obligatoire."},
 *             "password": {"Le mot de passe doit contenir au moins 8 caractères."}
 *         }
 *     )
 * )
 */
class Error422 {}
