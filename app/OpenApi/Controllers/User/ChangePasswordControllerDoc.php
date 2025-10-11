<?php

namespace App\OpenApi\Controllers\User;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/user/change-password",
 *     summary="Changer le mot de passe d'un utilisateur authentifié",
 *     description="Permet à l'utilisateur connecté de changer son mot de passe en fournissant l'ancien et le nouveau mot de passe.",
 *     tags={"User"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             type="object",
 *             required={"currentPassword","newPassword","newPassword_confirmation"},
 *
 *             @OA\Property(property="currentPassword", type="string", example="ancienMotDePasse123"),
 *             @OA\Property(property="newPassword", type="string", example="nouveauMotDePasse123"),
 *             @OA\Property(property="newPassword_confirmation", type="string", example="nouveauMotDePasse123")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Mot de passe modifié avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Mot de passe modifié avec succès.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Erreur lors du changement de mot de passe",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Mot de passe actuel incorrect.")
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
 *         response=422,
 *         description="Données invalides ou confirmation du mot de passe échouée",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="message", type="string", example="Le champ newPassword doit être confirmé.")
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
 *             @OA\Property(property="message", type="string", example="Une erreur est survenue")
 *         )
 *     )
 * )
 */
class ChangePasswordControllerDoc {}
