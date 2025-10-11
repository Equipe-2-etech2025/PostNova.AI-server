<?php

namespace App\OpenApi\Controllers\SocialPost;

/**
 * @OA\Get(
 *     path="/api/social-posts/{id}",
 *     summary="Afficher un post social",
 *     description="Retourne un post social par son ID",
 *     tags={"SocialPosts"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID du post social",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Post social trouvé",
 *
 *         @OA\JsonContent(ref="#/components/schemas/SocialPostResource")
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
 *         response=404,
 *         description="Post non trouvé",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Post social non trouvé"))
 *     )
 * )
 */
class SocialPostShowControllerDoc {}
