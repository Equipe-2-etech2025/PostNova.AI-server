<?php

namespace App\OpenApi\Controllers\User;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/users/{id}",
 *     summary="Afficher un utilisateur",
 *     description="Récupère les informations d'un utilisateur spécifique",
 *     operationId="UserShow",
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
 *     @OA\Response(
 *         response=200,
 *         description="Succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", ref="#/components/schemas/UserResource")
 *         )
 *     ),
 *
 *     @OA\Response(response=401, description="Non authentifié"),
 *     @OA\Response(response=403, description="Accès non autorisé"),
 *     @OA\Response(response=500, description="Erreur interne du serveur")
 * )
 */
class UserShowControllerDoc {}
