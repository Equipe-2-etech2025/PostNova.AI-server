<?php

namespace App\OpenApi\Controllers\SocialPost;

/**
 * @OA\Delete(
 *     path="/api/social-posts/{id}",
 *     summary="Supprimer un post social",
 *     description="Supprime un post social par ID",
 *     tags={"SocialPosts"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID du post social à supprimer",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Post supprimé avec succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Supprimé avec succès.")
 *         )
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
class SocialPostDestroyControllerDoc {}
