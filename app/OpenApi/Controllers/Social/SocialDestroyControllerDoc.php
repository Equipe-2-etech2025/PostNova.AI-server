<?php

namespace App\OpenApi\Controllers\Social;

/**
 * @OA\Delete(
 *     path="/api/socials/{id}",
 *     summary="Supprimer un post social",
 *     description="Supprime un post social existant.",
 *     tags={"Socials"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID du post social",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=7)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Post social supprimé avec succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Supprimé avec succès.")
 *         )
 *     ),
 *
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=403, description="Accès refusé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=404, description="Post social non trouvé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=500, description="Erreur interne du serveur", @OA\JsonContent(ref="#/components/schemas/ErrorResponse"))
 * )
 */
class SocialDestroyControllerDoc {}
