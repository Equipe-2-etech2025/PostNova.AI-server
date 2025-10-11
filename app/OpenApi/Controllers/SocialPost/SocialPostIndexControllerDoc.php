<?php

namespace App\OpenApi\Controllers\SocialPost;

/**
 * @OA\Get(
 *     path="/api/social-posts/index",
 *     summary="Lister tous les posts sociaux",
 *     description="Retourne tous les posts sociaux. Les autorisations sont respectées selon le rôle de l'utilisateur.",
 *     tags={"SocialPosts"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des posts sociaux",
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
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Non authentifié"))
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Accès refusé"))
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Erreur interne du serveur"))
 *     )
 * )
 */
class SocialPostIndexControllerDoc {}
