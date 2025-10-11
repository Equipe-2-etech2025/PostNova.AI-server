<?php

namespace App\OpenApi\Controllers\Features;

/**
 * @OA\Get(
 *     path="/api/features/search",
 *     summary="Rechercher des fonctionnalités selon des critères",
 *     description="Filtre les Features par critères",
 *     tags={"Features"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         required=false,
 *         description="Filtrer par ID utilisateur",
 *
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         required=false,
 *         description="Filtrer par nom de feature",
 *
 *         @OA\Schema(type="string", example="Campagne")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Résultats filtrés",
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
 *                 "message": "Vous n'avez pas la permission de rechercher ces fonctionnalités",
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
class FeaturesCriteriaControllerDoc {}
