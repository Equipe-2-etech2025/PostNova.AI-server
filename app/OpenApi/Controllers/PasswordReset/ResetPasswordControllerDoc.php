<?php

namespace App\OpenApi\Controllers\PasswordReset;

/**
 * @OA\Post(
 *     path="/api/password/reset",
 *     summary="Réinitialiser le mot de passe",
 *     description="Réinitialise le mot de passe utilisateur avec un token de réinitialisation valide",
 *     operationId="resetPassword",
 *     tags={"PasswordReset"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *         description="Données pour réinitialiser le mot de passe",
 *
 *         @OA\JsonContent(
 *             required={"token", "email", "password", "password_confirmation"},
 *
 *             @OA\Property(property="token", type="string", example="token123"),
 *             @OA\Property(property="email", type="string", format="email", example="user@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="NewPassword123!"),
 *             @OA\Property(property="password_confirmation", type="string", format="password", example="NewPassword123!")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Mot de passe réinitialisé avec succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Mot de passe réinitialisé avec succès.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Données de validation invalides",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Les données fournies sont invalides."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 example={
 *                     "email": {"L'adresse email est invalide."},
 *                     "password": {
 *                         "Le mot de passe doit contenir au moins 8 caractères.",
 *                         "Le mot de passe doit contenir au moins une lettre majuscule.",
 *                         "Le mot de passe doit contenir au moins un chiffre."
 *                     },
 *                     "password_confirmation": {"La confirmation du mot de passe ne correspond pas."}
 *                 }
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur interne",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Une erreur interne est survenue. Veuillez réessayer plus tard."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 example={
 *                     "server": {"Erreur lors de la mise à jour du mot de passe."}
 *                 }
 *             ),
 *             @OA\Property(property="debug", type="object", example={}, description="Informations de débogage (uniquement en environnement de développement)")
 *         )
 *     )
 * )
 */
class ResetPasswordControllerDoc {}
