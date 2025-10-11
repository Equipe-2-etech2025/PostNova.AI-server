<?php

namespace App\OpenApi\Controllers\Image;

/**
 * @OA\Get(
 *     path="/api/images/{id}",
 *     summary="Afficher une image",
 *     description="Retourne les détails d'une image spécifique par son ID.",
 *     tags={"Images"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de l'image à récupérer",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=7)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Détails de l'image",
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
 *             @OA\Property(property="message", type="string", example="Vous devez être authentifié.")
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
 *             @OA\Property(property="message", type="string", example="Vous n'avez pas la permission de visualiser cette image.")
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
 *             @OA\Property(property="message", type="string", example="Image introuvable avec l'ID fourni.")
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
 *             @OA\Property(property="message", type="string", example="Erreur interne du serveur lors de la récupération de l'image.")
 *         )
 *     )
 * )
 */
class ImageShowControllerDoc {}
