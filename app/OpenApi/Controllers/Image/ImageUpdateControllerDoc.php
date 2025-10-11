<?php

namespace App\OpenApi\Controllers\Image;

/**
 * @OA\Put(
 *     path="/api/images/{id}",
 *     summary="Mettre à jour une image",
 *     description="Met à jour les informations d'une image spécifique.",
 *     tags={"Images"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de l'image à mettre à jour",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=7)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="path", type="string", example="/images/updated.jpg")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Image mise à jour avec succès",
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
 *             @OA\Property(property="message", type="string", example="Vous devez être connecté pour effectuer cette action.")
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
 *             @OA\Property(property="message", type="string", example="Vous n’avez pas la permission de modifier cette image.")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Image non trouvée",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="message", type="string", example="L'image avec l'ID fourni est introuvable.")
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
 *                 @OA\Property(property="path", type="array", @OA\Items(type="string", example="Le champ path doit être une URL valide."))
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
 *             @OA\Property(property="message", type="string", example="Erreur interne du serveur lors de la mise à jour de l'image.")
 *         )
 *     )
 * )
 */
class ImageUpdateControllerDoc {}
