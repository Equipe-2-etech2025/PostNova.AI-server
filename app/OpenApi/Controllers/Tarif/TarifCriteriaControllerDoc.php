<?php

namespace App\OpenApi\Controllers\Tarif;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/tarifs/search",
 *     summary="Lister les tarifs selon des critères",
 *     description="Retourne une liste de tarifs filtrés selon les critères passés en query parameters.",
 *     tags={"Tarifs"},
 *
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         description="Filtrer par nom du tarif",
 *         required=false,
 *
 *         @OA\Schema(type="string")
 *     ),
 *
 *     @OA\Parameter(
 *         name="amount",
 *         in="query",
 *         description="Filtrer par montant",
 *         required=false,
 *
 *         @OA\Schema(type="number", format="float")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des tarifs récupérée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
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
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Unauthorized")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Forbidden")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Une erreur est survenue")
 *         )
 *     )
 * )
 */
class TarifCriteriaControllerDoc {}
