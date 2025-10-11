<?php

namespace App\OpenApi\Controllers\Image;

/**
 * @OA\Post(
 *     path="/api/images/generate",
 *     summary="Générer une image",
 *     description="Génère une image à partir d'un prompt et l'associe à une campagne.",
 *     tags={"Images"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="prompt", type="string", example="Une illustration futuriste d'une ville"),
 *             @OA\Property(property="campaign_id", type="integer", example=3),
 *             @OA\Property(property="prompt_id", type="integer", example=12)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Image générée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Image générée avec succès"),
 *             @OA\Property(property="images", type="array", @OA\Items(ref="#/components/schemas/ImageResource")),
 *             @OA\Property(property="data", type="object",
 *                 @OA\Property(property="image", ref="#/components/schemas/ImageResource"),
 *                 @OA\Property(property="image_url", type="string", example="/images/example.jpg")
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": false,
 *                 "message": "Vous devez être connecté pour générer une image",
 *                 "errors": {}
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": false,
 *                 "message": "Vous n'avez pas la permission de générer une image pour cette campagne",
 *                 "errors": {}
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Validation échouée",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": false,
 *                 "message": "Données invalides",
 *                 "errors": {
 *                     "prompt": {"Le champ prompt est obligatoire."},
 *                     "campaign_id": {"Le champ campaign_id doit être un entier valide."}
 *                 }
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur inattendue",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": false,
 *                 "message": "Erreur interne du serveur lors de la génération de l'image",
 *                 "errors": {}
 *             }
 *         )
 *     )
 * )
 */
class ImageGenerationControllerDoc {}
