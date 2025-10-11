<?php

namespace App\OpenApi\Controllers\Features;

/**
 * @OA\Get(
 *     path="/api/features",
 *     summary="Lister toutes les fonctionnalités",
 *     description="Retourne la liste complète des Features disponibles.",
 *     tags={"Features"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des fonctionnalités récupérée avec succès",
 *
 *         @OA\JsonContent(ref="#/components/schemas/FeatureCollection")
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Vous devez être connecté pour accéder à cette ressource",
 *                 "errors": {}
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Non autorisé",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Vous n'avez pas la permission de lister les fonctionnalités",
 *                 "errors": {}
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
 *                 "message": "Une erreur interne est survenue, veuillez réessayer plus tard",
 *                 "errors": {}
 *             }
 *         )
 *     )
 * )
 */
class FeaturesIndexControllerDoc {}
