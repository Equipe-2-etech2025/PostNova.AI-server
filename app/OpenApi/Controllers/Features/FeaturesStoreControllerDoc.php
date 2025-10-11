<?php

namespace App\OpenApi\Controllers\Features;

/**
 * @OA\Post(
 *     path="/api/features",
 *     summary="Créer une nouvelle fonctionnalité",
 *     description="Crée un Feature et le retourne.",
 *     tags={"Features"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             type="object",
 *             required={"name"},
 *
 *             @OA\Property(property="name", type="string", example="Nouvelle fonctionnalité")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Feature créée avec succès",
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
 *                 "message": "Vous n'avez pas la permission de créer une fonctionnalité",
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
 *                     "name": {"Le champ name est obligatoire ou trop long"},
 *                     "other_field": {"Valeur invalide pour other_field"}
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
class FeaturesStoreControllerDoc {}
