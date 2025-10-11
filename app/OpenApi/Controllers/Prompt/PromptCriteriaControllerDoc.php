<?php

namespace App\OpenApi\Controllers\Prompt;

/**
 * @OA\Get(
 *     path="/api/prompts/search",
 *     summary="Lister les prompts selon des critères",
 *     description="Retourne la liste des prompts filtrés selon les critères passés en query. Si l'utilisateur n'est pas admin, il ne verra que ses propres prompts.",
 *     operationId="searchPrompts",
 *     tags={"Prompts"},
 *
 *     @OA\Parameter(
 *         name="campaign_id",
 *         in="query",
 *         description="Filtrer par ID de campagne",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         description="Filtrer par ID d'utilisateur (admin uniquement)",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=12)
 *     ),
 *
 *     @OA\Parameter(
 *         name="search",
 *         in="query",
 *         description="Recherche textuelle dans le titre et le contenu",
 *         required=false,
 *
 *         @OA\Schema(type="string", example="marketing")
 *     ),
 *
 *     @OA\Parameter(
 *         name="page",
 *         in="query",
 *         description="Numéro de page",
 *         required=false,
 *
 *         @OA\Schema(type="integer", minimum=1, example=1)
 *     ),
 *
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         description="Nombre d'éléments par page",
 *         required=false,
 *
 *         @OA\Schema(type="integer", minimum=1, maximum=100, example=20)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des prompts",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="data", type="array",
 *
 *                 @OA\Items(ref="#/components/schemas/PromptResource")
 *             ),
 *
 *             @OA\Property(property="meta", type="object",
 *                 @OA\Property(property="total", type="integer", example=10),
 *                 @OA\Property(property="current_page", type="integer", example=1),
 *                 @OA\Property(property="last_page", type="integer", example=1),
 *                 @OA\Property(property="per_page", type="integer", example=20),
 *                 @OA\Property(property="from", type="integer", example=1),
 *                 @OA\Property(property="to", type="integer", example=10)
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(response=400, description="Paramètres invalides", @OA\JsonContent(ref="#/components/schemas/Error400")),
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/Error401")),
 *     @OA\Response(response=403, description="Accès refusé", @OA\JsonContent(ref="#/components/schemas/Error403")),
 *     @OA\Response(response=500, description="Erreur serveur", @OA\JsonContent(ref="#/components/schemas/Error500"))
 * )
 */
class PromptCriteriaControllerDoc {}
