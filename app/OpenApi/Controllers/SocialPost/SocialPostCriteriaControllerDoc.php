<?php

namespace App\OpenApi\Controllers\SocialPost;

/**
 * @OA\Get(
 *     path="/api/social-posts",
 *     summary="Lister les posts sociaux selon des critères",
 *     description="Retourne les posts sociaux filtrés selon les critères fournis. Les utilisateurs non-admins ne verront que leurs propres posts.",
 *     tags={"SocialPosts"},
 *
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         description="Filtrer par ID utilisateur (optionnel, seulement pour admins)",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *
 *     @OA\Parameter(
 *         name="campaign_id",
 *         in="query",
 *         description="Filtrer par ID de campagne (optionnel)",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=3)
 *     ),
 *
 *     @OA\Parameter(
 *         name="social_id",
 *         in="query",
 *         description="Filtrer par ID social (optionnel)",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des posts sociaux filtrés",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *
 *                 @OA\Items(ref="#/components/schemas/SocialPostResource")
 *             ),
 *
 *             @OA\Property(
 *                 property="meta",
 *                 type="object",
 *                 @OA\Property(property="total", type="integer", example=12)
 *             )
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
 *
 *             @OA\Property(property="message", type="string", example="Vous n'avez pas la permission d'accéder à cette ressource")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Ressource non trouvée",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Aucun post social trouvé")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Erreur interne du serveur")
 *         )
 *     )
 * )
 */
class SocialPostCriteriaControllerDoc {}
