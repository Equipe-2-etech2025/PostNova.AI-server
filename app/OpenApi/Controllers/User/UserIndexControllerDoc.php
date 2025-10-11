<?php

namespace App\OpenApi\Controllers\User;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/users",
 *     summary="Lister les utilisateurs",
 *     description="Récupère une liste paginée des utilisateurs. Possibilité de filtrer par rôle et vérification email, et de trier par colonnes.",
 *     tags={"User"},
 *
 *     @OA\Parameter(
 *         name="role",
 *         in="query",
 *         description="Filtrer par rôle",
 *         required=false,
 *
 *         @OA\Schema(type="string", example="admin")
 *     ),
 *
 *     @OA\Parameter(
 *         name="verified",
 *         in="query",
 *         description="Filtrer par utilisateurs vérifiés (true/false)",
 *         required=false,
 *
 *         @OA\Schema(type="boolean", example=true)
 *     ),
 *
 *     @OA\Parameter(
 *         name="sort_by",
 *         in="query",
 *         description="Colonne de tri",
 *         required=false,
 *
 *         @OA\Schema(type="string", example="created_at")
 *     ),
 *
 *     @OA\Parameter(
 *         name="sort_order",
 *         in="query",
 *         description="Ordre de tri",
 *         required=false,
 *
 *         @OA\Schema(type="string", enum={"asc","desc"}, example="desc")
 *     ),
 *
 *     @OA\Parameter(
 *         name="per_page",
 *         in="query",
 *         description="Nombre d'utilisateurs par page",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=15)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des utilisateurs récupérée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *
 *                 @OA\Items(ref="#/components/schemas/UserResource")
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès non autorisé",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Accès non autorisé.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="message", type="string", example="Une erreur est survenue.")
 *         )
 *     )
 * )
 */
class UserIndexControllerDoc {}
