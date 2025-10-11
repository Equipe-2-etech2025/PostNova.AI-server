<?php

namespace App\OpenApi\Controllers\Tarif;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/tarifs/{id}",
 *     summary="Afficher un tarif",
 *     description="Récupère les informations d’un tarif spécifique par ID",
 *     tags={"Tarifs"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du tarif",
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Détails du tarif",
 *
 *         @OA\JsonContent(ref="#/components/schemas/TarifResource")
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
 *         response=404,
 *         description="Tarif non trouvé",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Tarif introuvable."))
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
class TarifShowControllerDoc {}
