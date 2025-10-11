<?php

namespace App\OpenApi\Controllers\Image;

/**
 * @OA\Get(
 *     path="/api/images/search",
 *     summary="Lister les images selon des critères",
 *     description="Retourne une collection d’images filtrées par critères (par défaut limité à l’utilisateur connecté sauf si admin).",
 *     tags={"Images"},
 *
 *     @OA\Parameter(
 *         name="campaign_id",
 *         in="query",
 *         description="Filtrer par ID de campagne",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *
 *     @OA\Parameter(
 *         name="is_published",
 *         in="query",
 *         description="Filtrer les images publiées ou non",
 *         required=false,
 *
 *         @OA\Schema(type="boolean", example=true)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des images filtrées",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ImageCollection")
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
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
 *         description="Accès refusé (droits insuffisants)",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Vous n'avez pas la permission de voir ces images",
 *                 "errors": {}
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Aucune image trouvée pour les critères fournis",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Aucune image correspondante trouvée",
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
class ImageCriteriaControllerDoc {}
