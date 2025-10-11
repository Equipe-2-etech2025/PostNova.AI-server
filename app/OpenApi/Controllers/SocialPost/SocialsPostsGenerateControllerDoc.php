<?php

namespace App\OpenApi\Controllers\SocialPost;

/**
 * @OA\Post(
 *     path="/api/social-posts/generate",
 *     summary="Générer des posts pour plusieurs plateformes",
 *     description="Génère et crée des posts sur plusieurs plateformes à partir d'un topic, campagne et prompt",
 *     tags={"SocialPosts"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="topic", type="string", example="Nouvelle campagne"),
 *             @OA\Property(property="platforms", type="array", @OA\Items(type="string", enum={"linkedin","x","tiktok"})),
 *             @OA\Property(property="campaign_id", type="integer", example=1),
 *             @OA\Property(property="prompt_id", type="integer", example=1),
 *             @OA\Property(property="tone", type="string", example="friendly"),
 *             @OA\Property(property="language", type="string", example="french"),
 *             @OA\Property(property="hashtags", type="string", example="#marketing"),
 *             @OA\Property(property="target_audience", type="string", example="professionnels du marketing"),
 *             @OA\Property(property="is_published", type="boolean", example=true)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Posts générés avec succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="generated", type="boolean", example=true),
 *             @OA\Property(property="posts", type="array", @OA\Items(ref="#/components/schemas/SocialPostResource")),
 *             @OA\Property(property="count", type="integer", example=3)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Erreur de validation"))
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur lors de la génération",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Failed to generate posts"),
 *             @OA\Property(property="error", type="string", example="Exception message")
 *         )
 *     )
 * )
 */
class SocialsPostsGenerateControllerDoc {}
