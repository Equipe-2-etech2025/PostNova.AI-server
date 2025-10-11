<?php

namespace App\OpenApi\Controllers\Features;

/**
 * @OA\Put(
 *     path="/api/features/{id}",
 *     summary="Mettre à jour une fonctionnalité",
 *     description="Met à jour un Feature existant.",
 *     tags={"Features"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du Feature",
 *
 *         @OA\Schema(type="integer", example=8)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="name", type="string", example="Nom modifié")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Feature mis à jour",
 *
 *         @OA\JsonContent(ref="#/components/schemas/FeatureResource")
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
 *                 "message": "Vous n'avez pas la permission de modifier cette fonctionnalité",
 *                 "errors": {}
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Feature non trouvé",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Aucune fonctionnalité trouvée avec l'ID fourni",
 *                 "errors": {}
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Les données fournies sont invalides",
 *                 "errors": {
 *                     "name": {"Le champ name est obligatoire ou invalide"}
 *                 }
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
class FeaturesUpdateControllerDoc {}
