<?php

namespace App\OpenApi\Controllers\User;

use OpenApi\Annotations as OA;

/**
 * @OA\Delete(
 *     path="/api/user/{id}",
 *     summary="Supprimer un utilisateur",
 *     description="Supprime un utilisateur spécifié par son ID. L'utilisateur authentifié ne peut pas se supprimer lui-même.",
 *     tags={"User"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de l'utilisateur à supprimer",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Utilisateur supprimé avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Utilisateur supprimé avec succès.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Tentative de suppression de son propre compte",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Vous ne pouvez pas supprimer votre propre compte.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="message", type="string", example="Unauthorized")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Utilisateur non autorisé à effectuer cette action",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="message", type="string", example="Forbidden")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="message", type="string", example="Une erreur est survenue lors de la suppression de l'utilisateur.")
 *         )
 *     )
 * )
 */
class UserDestroyControllerDoc {}
