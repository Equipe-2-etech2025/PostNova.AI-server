<?php

namespace App\OpenApi\Controllers\SocialPost;

/**
 * @OA\Post(
 *     path="/api/social-posts",
 *     summary="Créer un post social",
 *     description="Créer un nouveau post social à partir d'un prompt et d'une campagne",
 *     tags={"SocialPosts"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="content", type="string", example="Contenu du post"),
 *             @OA\Property(property="prompt_id", type="integer", example=1),
 *             @OA\Property(property="social_id", type="integer", example=2),
 *             @OA\Property(property="campaign_id", type="integer", example=3),
 *             @OA\Property(property="is_published", type="boolean", example=true)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Post créé avec succès",
 *
 *         @OA\JsonContent(ref="#/components/schemas/SocialPostResource")
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erreur de validation ou contenu invalide",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="type", type="string", example="no_content")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Accès refusé"))
 *     )
 * )
 */
class SocialPostStoreControllerDoc {}
