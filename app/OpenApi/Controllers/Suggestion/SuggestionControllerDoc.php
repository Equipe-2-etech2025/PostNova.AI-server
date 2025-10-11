<?php

namespace App\OpenApi\Controllers\Suggestion;

/**
 * @OA\Get(
 *     path="/api/suggestions/{userId}",
 *     summary="Récupérer les suggestions pour un utilisateur",
 *     description="Renvoie la liste des suggestions pour l'utilisateur authentifié",
 *     tags={"Suggestions"},
 *
 *     @OA\Parameter(
 *         name="userId",
 *         in="path",
 *         description="ID de l'utilisateur",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Suggestions récupérées avec succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(
 *                 property="suggestions",
 *                 type="array",
 *
 *                 @OA\Items(
 *                     type="object",
 *
 *                     @OA\Property(property="id", type="integer", example=1),
 *                     @OA\Property(property="title", type="string", example="Titre de la suggestion"),
 *                     @OA\Property(property="description", type="string", example="Description détaillée"),
 *                     @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 10:00:00")
 *                 )
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur lors de la récupération des suggestions",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Une erreur est survenue lors de la récupération des suggestions.")
 *         )
 *     )
 * )
 */
class SuggestionControllerDoc {}
