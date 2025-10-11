<?php

namespace App\OpenApi\Controllers\Auth;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/auth/login",
 *     summary="Connexion utilisateur",
 *     description="Authentifie un utilisateur et retourne un token JWT",
 *     tags={"Authentication"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *         description="Données de connexion",
 *
 *         @OA\JsonContent(
 *             required={"email", "password"},
 *
 *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="Password123!")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Connexion réussie",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(
 *                 property="success",
 *                 type="boolean",
 *                 example=true
 *             ),
 *             @OA\Property(
 *                 property="message",
 *                 type="string",
 *                 example="Connexion réussie."
 *             ),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(
 *                     property="user",
 *                     type="object",
 *                     ref="#/components/schemas/User"
 *                 ),
 *                 @OA\Property(
 *                     property="token",
 *                     type="string",
 *                     example="1|a1b2c3d4e5f6g7h8i9j0..."
 *                 ),
 *                 @OA\Property(
 *                     property="token_type",
 *                     type="string",
 *                     example="Bearer"
 *                 )
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Email ou mot de passe invalide",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Email ou mot de passe invalide"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 nullable=true
 *             )
 *         )
 *     )
 * )
 */
class LoginControllerDoc {}
