<?php

namespace App\OpenApi\Controllers\SocialPost;

/**
 * @OA\Put(
 *     path="/api/social-posts/{id}",
 *     summary="Mettre à jour un post social",
 *     description="Met à jour un post social existant",
 *     tags={"SocialPosts"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du post social à mettre à jour",
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="content", type="string", example="Contenu mis à jour"),
 *             @OA\Property(property="is_published", type="boolean", example=false)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Post mis à jour",
 *
 *         @OA\JsonContent(ref="#/components/schemas/SocialPostResource")
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
class SocialPostUpdateControllerDoc {}
