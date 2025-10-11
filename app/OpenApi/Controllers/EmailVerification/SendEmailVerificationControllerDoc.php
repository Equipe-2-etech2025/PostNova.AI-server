<?php

namespace App\OpenApi\Controllers\EmailVerification;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/email/send-verification",
 *     summary="Envoyer email de vérification",
 *     description="Envoie un email de vérification si l'email n'est pas encore vérifié",
 *     tags={"Email Verification"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Email de vérification envoyé",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Email de vérification envoyé.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Requête invalide ou email déjà vérifié",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse",
 *             example={"success": false, "message": "L'email est déjà vérifié"})
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse",
 *             example={"success": false, "message": "Vous devez être connecté"})
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès interdit",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse",
 *             example={"success": false, "message": "Vous n'avez pas la permission d'envoyer cet email"})
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Utilisateur introuvable",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse",
 *             example={"success": false, "message": "Utilisateur non trouvé"})
 *     ),
 *
 *     @OA\Response(
 *         response=429,
 *         description="Trop de requêtes (rate limit)",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse",
 *             example={"success": false, "message": "Trop de tentatives, veuillez réessayer plus tard"})
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse",
 *             example={"success": false, "message": "Une erreur interne est survenue"})
 *     )
 * )
 */
class SendEmailVerificationControllerDoc {}
