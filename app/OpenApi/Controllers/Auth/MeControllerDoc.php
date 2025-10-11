<?php

namespace App\OpenApi\Controllers\Auth;

/**
 * @OA\Get(
 *     path="/api/auth/me",
 *     summary="Récupérer les informations de l'utilisateur connecté",
 *     tags={"Authentication"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Informations utilisateur",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="data", type="object")
 *         )
 *     )
 * )
 */
class MeControllerDoc {}
