<?php

namespace App\OpenApi\Controllers\Prompt;

/**
 * @OA\Get(
 *     path="/api/prompts/index",
 *     summary="Lister tous les prompts",
 *     description="Retourne la liste de tous les prompts.",
 *     tags={"Prompts"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des prompts",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="data", type="array", @OA\Items(ref="#/components/schemas/PromptResource")),
 *             @OA\Property(property="total", type="integer", example=15)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Non authentifié")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(
 *              ref="#/components/schemas/ErrorResponse",
 *              example={
 *                  "success": false,
 *                  "message": "Vous n’avez pas les permissions nécessaires pour accéder à cette ressource",
 *                  "errors": {}
 *              }
 *          )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(
 *              ref="#/components/schemas/ErrorResponse",
 *              example={
 *                  "success": false,
 *                  "message": "Une erreur interne est survenue lors de la récupération des campagnes"
 *              }
 *          )
 *     )
 * )
 */
class PromptIndexControllerDoc {}
