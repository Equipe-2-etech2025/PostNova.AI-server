<?php

namespace App\OpenApi\Controllers\LandingPage;

/**
 * @OA\Post(
 *     path="/api/landing-pages",
 *     summary="Créer une landing page",
 *     description="Crée une nouvelle landing page pour une campagne spécifique.",
 *     tags={"LandingPages"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(
 *                 property="content",
 *                 type="array",
 *
 *                 @OA\Items(
 *                     type="object",
 *
 *                     @OA\Property(property="type", type="string", example="text"),
 *                     @OA\Property(property="value", type="string", example="Bienvenue")
 *                 )
 *             ),
 *             @OA\Property(property="campaign_id", type="integer", example=5),
 *             @OA\Property(property="prompt_id", type="integer", example=12)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Landing page créée avec succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", ref="#/components/schemas/LandingPageResource")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Validation échouée",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Validation failed"),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(
 *                     property="content",
 *                     type="array",
 *
 *                     @OA\Items(type="string", example="Le champ content est requis")
 *                 ),
 *
 *                 @OA\Property(
 *                     property="campaign_id",
 *                     type="array",
 *
 *                     @OA\Items(type="string", example="Le champ campaign_id est requis")
 *                 )
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
 *     )
 * )
 */
class LandingPageStoreControllerDoc {}
