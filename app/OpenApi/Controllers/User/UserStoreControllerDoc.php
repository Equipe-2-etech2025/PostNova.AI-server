<?php

namespace App\OpenApi\Controllers\User;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/users",
 *     summary="Créer un utilisateur",
 *     description="Crée un nouvel utilisateur",
 *     operationId="UserStore",
 *     tags={"Users"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="name", type="string", example="John Doe"),
 *             @OA\Property(property="email", type="string", example="john@example.com"),
 *             @OA\Property(property="password", type="string", example="secret123"),
 *             @OA\Property(property="role", type="string", enum={"user","admin"}, example="user")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Utilisateur créé avec succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Utilisateur créé avec succès."),
 *             @OA\Property(property="data", ref="#/components/schemas/UserResource")
 *         )
 *     ),
 *
 *     @OA\Response(response=400, description="Données invalides ou erreur"),
 *     @OA\Response(response=401, description="Non authentifié"),
 *     @OA\Response(response=403, description="Accès non autorisé"),
 *     @OA\Response(response=500, description="Erreur interne du serveur")
 * )
 */
class UserStoreControllerDoc {}
