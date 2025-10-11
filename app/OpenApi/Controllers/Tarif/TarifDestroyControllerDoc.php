<?php

namespace App\OpenApi\Controllers\Tarif;

use OpenApi\Annotations as OA;

/**
 * @OA\Delete(
 *     path="/api/tarifs/{id}",
 *     summary="Supprimer un tarif",
 *     description="Supprime un tarif existant par son identifiant",
 *     tags={"Tarifs"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du tarif à supprimer",
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Tarif supprimé avec succès",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Supprimé avec succès.")
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
 *         response=404,
 *         description="Tarif non trouvé",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="Tarif introuvable.")
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
class TarifDestroyControllerDoc {}
