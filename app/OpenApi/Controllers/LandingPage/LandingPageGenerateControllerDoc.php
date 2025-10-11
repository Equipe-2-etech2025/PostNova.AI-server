<?php

namespace App\OpenApi\Controllers\LandingPage;

/**
 * @OA\Post(
 *     path="/api/landing-pages/generate",
 *     summary="Générer une landing page",
 *     description="Génère une landing page à partir d'un prompt pour une campagne spécifique.",
 *     tags={"LandingPages"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *         description="Données pour générer la landing page",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="prompt", type="string", example="Créer une landing page pour notre nouveau produit X."),
 *             @OA\Property(property="campaign_id", type="integer", example=12),
 *             @OA\Property(property="prompt_id", type="integer", example=7)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Landing page générée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="id", type="integer", example=1),
 *                 @OA\Property(property="content", type="array",
 *
 *                     @OA\Items(type="string", example={"Titre principal", "Sous-titre", "CTA"})
 *                 ),
 *
 *                 @OA\Property(property="campaign_id", type="integer", example=12),
 *                 @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 16:00:00"),
 *             ),
 *             @OA\Property(property="message", type="string", example="Landing page générée avec succès")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Fallback utilisé suite à une erreur",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="object"),
 *             @OA\Property(property="fallback", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Landing page générée avec un template de base suite à une erreur")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Validation échouée",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Validation failed"),
 *             @OA\Property(property="errors", type="object",
 *                 example={"prompt": {"Le champ prompt est requis"}, "campaign_id": {"Le champ campaign_id doit être un entier"}}
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Erreur lors de la génération de la landing page"),
 *             @OA\Property(property="error", type="string", example="Détails de l'exception")
 *         )
 *     )
 * )
 */
class LandingPageGenerateControllerDoc {}
