<?php

namespace App\OpenApi\Controllers\LandingPage;

/**
 * @OA\Delete(
 *     path="/api/landing-pages/{id}",
 *     summary="Supprimer une landing page",
 *     description="Supprime une landing page spécifique.",
 *     tags={"LandingPages"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la landing page",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Landing page supprimée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Landing page supprimée avec succès")
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
 *         response=404,
 *         description="Landing page non trouvée",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse")
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
 *             @OA\Property(property="message", type="string", example="Erreur interne du serveur lors de la suppression de la landing page")
 *         )
 *     )
 * )
 */
class LandingPageDestroyControllerDoc {}
