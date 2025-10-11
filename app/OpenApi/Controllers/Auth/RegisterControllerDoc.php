<?php

namespace App\OpenApi\Controllers\Auth;

/**
 * @OA\Post(
 *     path="/api/auth/register",
 *     summary="Inscription utilisateur",
 *     tags={"Authentication"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"name","email","password","password_confirmation"},
 *
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", format="email", example="john.doe@example.com"),
 *             @OA\Property(property="password", type="string", format="password", example="Password123!"),
 *             @OA\Property(property="password_confirmation", type="string", format="password", example="Password123!")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Inscription réussie",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Inscription réussie"),
 *             @OA\Property(
 *                 property="data",
 *                 type="object",
 *                 @OA\Property(property="user", ref="#/components/schemas/User"),
 *                 @OA\Property(property="token", type="string", example="1|a1b2c3d4e5f6..."),
 *                 @OA\Property(property="token_type", type="string", example="Bearer")
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error422")
 *     ),
 *
 *     @OA\Response(response=500, description="Erreur serveur", @OA\JsonContent(ref="#/components/schemas/Error500"))
 * )
 */
class RegisterControllerDoc {}
