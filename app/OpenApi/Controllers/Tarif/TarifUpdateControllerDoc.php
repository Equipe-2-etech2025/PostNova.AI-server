<?php

namespace App\OpenApi\Controllers\Tarif;

use OpenApi\Annotations as OA;

/**
 * @OA\Put(
 *     path="/api/tarifs/{id}",
 *     summary="Mettre à jour un tarif",
 *     description="Met à jour les informations d’un tarif existant",
 *     tags={"Tarifs"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID du tarif à mettre à jour",
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"name", "amount", "max_limit"},
 *
 *             @OA\Property(property="name", type="string", example="Tarif Standard"),
 *             @OA\Property(property="amount", type="number", format="float", example=29.99),
 *             @OA\Property(property="max_limit", type="integer", example=50)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Tarif mis à jour avec succès",
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
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(property="errors", type="object", example={"amount": {"Le champ amount doit être un nombre."}})
 *         )
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
class TarifUpdateControllerDoc {}
