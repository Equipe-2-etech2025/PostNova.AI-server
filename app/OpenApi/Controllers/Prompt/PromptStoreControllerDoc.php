<?php

namespace App\OpenApi\Controllers\Prompt;

/**
 * @OA\Post(
 *     path="/api/prompts",
 *     summary="Créer un prompt",
 *     description="Crée un nouveau prompt pour une campagne spécifique.",
 *     tags={"Prompts"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="content", type="string", example="Créer un prompt pour campagne X"),
 *             @OA\Property(property="campaign_id", type="integer", example=5),
 *             @OA\Property(property="prompt_id", type="integer", example=12)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Prompt créé avec succès",
 *
 *         @OA\JsonContent(ref="#/components/schemas/PromptResource")
 *     ),
 *
 *     @OA\Response(response=400, description="Quota dépassé ou tarif manquant", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=403, description="Accès refusé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=422, description="Validation échouée", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=500, description="Erreur interne du serveur", @OA\JsonContent(ref="#/components/schemas/ErrorResponse"))
 * )
 */
class PromptStoreControllerDoc {}
