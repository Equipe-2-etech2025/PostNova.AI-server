<?php

namespace App\OpenApi\Controllers\TarifFeature;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/tarif-features",
 *     summary="Créer une nouvelle caractéristique de tarif",
 *     description="Crée un TarifFeature pour un tarif donné.",
 *     tags={"Tarif Features"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"tarif_id","name"},
 *
 *             @OA\Property(property="tarif_id", type="integer", example=2),
 *             @OA\Property(property="name", type="string", example="Support 24/7")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="TarifFeature créé avec succès",
 *
 *         @OA\JsonContent(ref="#/components/schemas/TarifFeatureResource")
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Données invalides",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Validation failed"))
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Forbidden"))
 *     )
 * )
 */
class TarifFeatureStoreControllerDoc {}
