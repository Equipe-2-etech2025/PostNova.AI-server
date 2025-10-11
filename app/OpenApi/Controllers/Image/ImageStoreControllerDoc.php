<?php

namespace App\OpenApi\Controllers\Image;

/**
 * @OA\Post(
 *     path="/api/images",
 *     summary="Créer une nouvelle image",
 *     description="Crée une image pour une campagne.",
 *     tags={"Images"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="path", type="string", example="/images/example.jpg"),
 *             @OA\Property(property="campaign_id", type="integer", example=3),
 *             @OA\Property(property="prompt_id", type="integer", example=12)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Image créée avec succès",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ImageResource")
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Vous devez être connecté pour accéder à cette ressource.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Vous n’avez pas la permission de créer une image pour cette campagne.")
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
 *             @OA\Property(property="message", type="string", example="Les données fournies sont invalides."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 @OA\Property(property="path", type="array", @OA\Items(type="string", example="Le champ path est obligatoire.")),
 *                 @OA\Property(property="campaign_id", type="array", @OA\Items(type="string", example="La campagne spécifiée est introuvable."))
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur inattendue",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="Erreur interne du serveur lors de la création de l'image.")
 *         )
 *     )
 * )
 */
class ImageStoreControllerDoc {}
