<?php

namespace App\OpenApi\Controllers\Prompt;

/**
 * @OA\Put(
 *     path="/api/prompts/{id}",
 *     summary="Mettre à jour un prompt",
 *     description="Met à jour le contenu d'un prompt spécifique.",
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
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="content", type="string", example="Nouveau contenu du prompt")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Prompt mis à jour avec succès",
 *
 *         @OA\JsonContent(ref="#/components/schemas/PromptResource")
 *     ),
 *
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=403, description="Accès refusé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=404, description="Prompt non trouvé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=422, description="Validation échouée", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=500, description="Erreur interne du serveur", @OA\JsonContent(ref="#/components/schemas/ErrorResponse"))
 * )
 */
class PromptUpdateControllerDoc {}
