<?php

namespace App\OpenApi\Controllers\User;

use OpenApi\Annotations as OA;

/**
 * @OA\Put(
 *     path="/api/users/{id}",
 *     summary="Mettre à jour un utilisateur",
 *     description="Met à jour les informations d'un utilisateur existant",
 *     operationId="UserUpdate",
 *     tags={"Users"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de l'utilisateur",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
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
 *         response=200,
 *         description="Utilisateur mis à jour avec succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Utilisateur mis à jour avec succès."),
 *             @OA\Property(property="data", ref="#/components/schemas/UserResource")
 *         )
 *     ),
 *
 *     @OA\Response(response=400, description="Données invalides"),
 *     @OA\Response(response=401, description="Non authentifié"),
 *     @OA\Response(response=403, description="Accès non autorisé"),
 *     @OA\Response(response=500, description="Erreur interne du serveur")
 * )
 */
class UserUpdateControllerDoc {}
