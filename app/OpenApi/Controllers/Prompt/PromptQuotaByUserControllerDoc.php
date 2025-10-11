<?php

namespace App\OpenApi\Controllers\Prompt;

/**
 * @OA\Get(
 *     path="/api/prompts/quota/{userId}",
 *     summary="Obtenir le quota de prompts utilisé par un utilisateur",
 *     description="Retourne le nombre de prompts utilisés aujourd'hui par un utilisateur donné.",
 *     tags={"Prompts"},
 *
 *     @OA\Parameter(
 *         name="userId",
 *         in="path",
 *         description="ID de l'utilisateur",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=12)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Quota de prompts utilisé",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="user_id", type="integer", example=12),
 *                 @OA\Property(property="daily_quota_used", type="integer", example=5)
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=403, description="Accès refusé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=500, description="Erreur interne du serveur", @OA\JsonContent(ref="#/components/schemas/ErrorResponse"))
 * )
 */
class PromptQuotaByUserControllerDoc {}
