<?php

namespace App\OpenApi\Controllers\TarifUser;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/tarif-users/search",
 *     summary="Récupérer les TarifUsers selon des critères",
 *     description="Retourne une collection de TarifUser filtrée selon les critères fournis. Si l'utilisateur n'est pas admin, seuls ses propres enregistrements sont renvoyés.",
 *     tags={"TarifUsers"},
 *
 *     @OA\Parameter(
 *         name="user_id",
 *         in="query",
 *         description="Filtrer par user_id (optionnel, non admin ignoré)",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Parameter(
 *         name="tarif_id",
 *         in="query",
 *         description="Filtrer par tarif_id (optionnel)",
 *         required=false,
 *
 *         @OA\Schema(type="integer", example=2)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Collection de TarifUser renvoyée avec succès",
 *
 *         @OA\JsonContent(ref="#/components/schemas/TarifUserCollection")
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
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
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Une erreur est survenue lors de la récupération des données"))
 *     )
 * )
 */
class TarifUserCriteriaControllerDoc {}
