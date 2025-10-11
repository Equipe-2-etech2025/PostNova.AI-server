<?php

namespace App\OpenApi\Controllers\EmailVerification;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/email/verify",
 *     summary="Vérifier l'email",
 *     description="Vérifie l'email à partir des paramètres du lien de vérification",
 *     tags={"Email Verification"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"id", "hash", "expires", "signature"},
 *
 *             @OA\Property(property="id", type="integer", example=1),
 *             @OA\Property(property="hash", type="string", example="abc123hash"),
 *             @OA\Property(property="expires", type="integer", example=1700000000),
 *             @OA\Property(property="signature", type="string", example="signatureexample")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Email vérifié avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Email vérifié avec succès."),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="user", ref="#/components/schemas/User"),
 *                 @OA\Property(property="token", type="string", example="1|a1b2c3..."),
 *                 @OA\Property(property="token_type", type="string", example="Bearer")
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Lien invalide, expiré ou email déjà vérifié",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Le lien de vérification est invalide ou a expiré."
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Utilisateur introuvable",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Aucun utilisateur trouvé pour l'ID fourni."
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=409,
 *         description="Email déjà vérifié",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Cet email est déjà vérifié."
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Une erreur interne est survenue, veuillez réessayer plus tard."
 *             }
 *         )
 *     )
 * )
 */
class VerifyEmailControllerDoc {}
