<?php

namespace App\OpenApi\Controllers\LandingPage;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/landing-pages/{id}",
 *     summary="Afficher une landing page",
 *     description="Retourne les détails d'une landing page spécifique.",
 *     tags={"LandingPages"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la landing page",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=7)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Détails de la landing page",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", ref="#/components/schemas/LandingPageResource")
 *         )
 *     )
 * )
 */
class LandingPageShowControllerDoc {}
