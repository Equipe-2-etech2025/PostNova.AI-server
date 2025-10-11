<?php

namespace App\OpenApi\Controllers\Image;

/**
 * @OA\Get(
 *     path="/api/images",
 *     summary="Lister les images",
 *     description="Retourne la liste des images de l'utilisateur (ou toutes pour un admin).",
 *     tags={"Images"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des images",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ImageCollection")
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
 *             @OA\Property(property="message", type="string", example="Vous n'avez pas la permission de visualiser ces images.")
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
 *             @OA\Property(property="message", type="string", example="Erreur interne du serveur lors de la récupération des images.")
 *         )
 *     )
 * )
 */
class ImageIndexControllerDoc {}
