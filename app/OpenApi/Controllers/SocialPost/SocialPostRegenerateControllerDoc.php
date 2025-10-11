<?php

namespace App\OpenApi\Controllers\SocialPost;

/**
 * @OA\Post(
 *     path="/api/social-posts/{id}/regenerate",
 *     summary="Régénérer un post social",
 *     description="Régénère le contenu d'un post social existant",
 *     tags={"SocialPosts"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID du post à régénérer",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="content", type="string", example="Nouveau contenu régénéré")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Post régénéré avec succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Post régénéré avec succès"),
 *             @OA\Property(property="data", type="object")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Aucun contenu généré",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="type", type="string", example="no_content")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne de régénération",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Erreur lors de la régénération"),
 *             @OA\Property(property="type", type="string", example="regeneration_error")
 *         )
 *     )
 * )
 */
class SocialPostRegenerateControllerDoc {}
