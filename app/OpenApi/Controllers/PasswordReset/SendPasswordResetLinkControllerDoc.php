<?php

namespace App\OpenApi\Controllers\PasswordReset;

/**
 * @OA\Post(
 *     path="/api/password/email",
 *     summary="Envoyer un lien de réinitialisation du mot de passe",
 *     description="Envoie un email contenant un lien de réinitialisation de mot de passe à l'adresse spécifiée",
 *     operationId="sendPasswordResetLink",
 *     tags={"PasswordReset"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *         description="Adresse email pour envoyer le lien",
 *
 *         @OA\JsonContent(
 *             required={"email"},
 *
 *             @OA\Property(
 *                 property="email",
 *                 type="string",
 *                 format="email",
 *                 description="Adresse email de l'utilisateur",
 *                 example="user@example.com"
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Lien de réinitialisation envoyé avec succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Lien de réinitialisation envoyé par email.")
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
 *                     "email": {
 *                         "Le champ email est obligatoire.",
 *                         "L'adresse email doit être une adresse email valide.",
 *                         "L'adresse email n'existe pas dans notre système.",
 *                         "Nous ne pouvons pas envoyer d'email à cette adresse.",
 *                         "Trop de tentatives. Veuillez réessayer dans 5 minutes."
 *                     }
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
 *             @OA\Property(property="message", type="string", example="Une erreur est survenue lors de l'envoi de l'email. Veuillez réessayer."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 example={
 *                     "server": {
 *                         "Impossible d'envoyer l'email de réinitialisation.",
 *                         "Erreur de connexion au service d'email.",
 *                         "Service d'email temporairement indisponible."
 *                     }
 *                 }
 *             )
 *         )
 *     )
 * )
 */
class SendPasswordResetLinkControllerDoc {}
