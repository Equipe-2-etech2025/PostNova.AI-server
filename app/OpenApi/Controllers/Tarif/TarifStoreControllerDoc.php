<?php

namespace App\OpenApi\Controllers\Tarif;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/tarifs",
 *     summary="Créer un tarif",
 *     description="Crée un nouveau tarif avec les données fournies",
 *     tags={"Tarifs"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"name", "amount", "max_limit"},
 *
 *             @OA\Property(property="name", type="string", example="Tarif Premium"),
 *             @OA\Property(property="amount", type="number", format="float", example=49.99),
 *             @OA\Property(property="max_limit", type="integer", example=100)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Tarif créé avec succès",
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
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(
 *
 *             @OA\Property(property="message", type="string", example="The given data was invalid."),
 *             @OA\Property(
 *                 property="errors",
 *                 type="object",
 *                 example={"name": {"Le champ name est obligatoire."}}
 *             )
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
class TarifStoreControllerDoc {}
