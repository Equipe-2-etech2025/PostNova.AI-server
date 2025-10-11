<?php

namespace App\OpenApi\Controllers\Tarif;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/tarifs",
 *     summary="Lister tous les tarifs",
 *     description="Récupère la liste complète des tarifs disponibles",
 *     tags={"Tarifs"},
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des tarifs",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *
 *                 @OA\Items(ref="#/components/schemas/TarifResource")
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Non authentifié",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Unauthorized"))
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Forbidden"))
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Une erreur est survenue"))
 *     )
 * )
 */
class TarifIndexControllerDoc {}
