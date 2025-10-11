<?php

namespace App\OpenApi\Schemas;

/**
 * @OA\Schema(
 *     schema="ErrorResponse",
 *     type="object",
 *     title="Erreur générique",
 *     description="Structure de réponse en cas d'erreur",
 *
 *     @OA\Property(property="success", type="boolean", example=false),
 *     @OA\Property(property="message", type="string", example="Une erreur est survenue"),
 *     @OA\Property(
 *         property="errors",
 *         type="object",
 *         description="Détails des erreurs de validation (optionnel)",
 *         example={"email": {"Le champ email est obligatoire."}}
 *     )
 * )
 */
class ErrorResponse {}
