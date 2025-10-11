<?php

namespace App\OpenApi\Controllers\Prompt;

/**
 * @OA\Get(
 *     path="/api/prompts/{id}",
 *     summary="Afficher un prompt",
 *     description="Retourne les détails d'un prompt spécifique.",
 *     tags={"Prompts"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID du prompt",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=7)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Détails du prompt",
 *
 *         @OA\JsonContent(ref="#/components/schemas/PromptResource")
 *     ),
 *
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=403, description="Accès refusé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=404, description="Prompt non trouvé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=500, description="Erreur interne du serveur", @OA\JsonContent(ref="#/components/schemas/ErrorResponse"))
 * )
 */
class PromptShowControllerDoc {}
