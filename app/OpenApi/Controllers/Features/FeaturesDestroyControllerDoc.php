<?php

namespace App\OpenApi\Controllers\Features;

/**
 * @OA\Delete(
 *     path="/api/features/{id}",
 *     summary="Supprimer une fonctionnalité",
 *     description="Supprime un Feature par son ID.",
 *     tags={"Features"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(name="id", in="path", required=true, description="ID du Feature", @OA\Schema(type="integer", example=10)),
 *
 *     @OA\Response(response=200, description="Supprimé avec succès", @OA\JsonContent(example={"message":"Supprimé avec succès."})),
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=403, description="Non autorisé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=404, description="Feature non trouvé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse")),
 *     @OA\Response(response=500, description="Erreur serveur", @OA\JsonContent(ref="#/components/schemas/ErrorResponse"))
 * )
 */
class FeaturesDestroyControllerDoc {}
