<?php

namespace App\OpenApi\Controllers\EmailVerification;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/email/verification-status",
 *     summary="Statut de vérification de l'email",
 *     description="Retourne le statut de vérification de l'email de l'utilisateur connecté",
 *     tags={"Email Verification"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Statut récupéré avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="verified", type="boolean", example=false),
 *             @OA\Property(property="email", type="string", example="john.doe@example.com"),
 *             @OA\Property(property="verified_at", type="string", format="date-time", nullable=true)
 *         )
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
 *             example={"success": false, "message": "Vous n'avez pas la permission de consulter ce statut"})
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
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse",
 *             example={"success": false, "message": "Une erreur interne est survenue"})
 *     )
 * )
 */
class EmailVerificationStatusControllerDoc {}
