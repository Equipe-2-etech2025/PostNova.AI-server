<?php

namespace App\OpenApi\Controllers\Features;

/**
 * @OA\Get(
 *     path="/api/features/{id}",
 *     summary="Voir une fonctionnalité",
 *     description="Retourne les détails d'un Feature selon son ID.",
 *     tags={"Features"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du Feature",
 *
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *
 *     @OA\Response(response=200, description="Feature trouvé", @OA\JsonContent(ref="#/components/schemas/FeatureResource")),
 *     @OA\Response(response=401, description="Non authentifié", @OA\JsonContent(ref="#/components/schemas/ErrorResponse", example={"success":false,"message":"Unauthenticated"})),
 *     @OA\Response(response=403, description="Non autorisé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse", example={"success":false,"message":"Accès interdit"})),
 *     @OA\Response(response=404, description="Feature non trouvé", @OA\JsonContent(ref="#/components/schemas/ErrorResponse", example={"success":false,"message":"Feature introuvable"})),
 *     @OA\Response(response=500, description="Erreur serveur", @OA\JsonContent(ref="#/components/schemas/ErrorResponse", example={"success":false,"message":"Erreur serveur"}))
 * )
 */
class FeaturesShowControllerDoc {}
