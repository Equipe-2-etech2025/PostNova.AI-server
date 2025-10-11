<?php

namespace App\OpenApi\Controllers\TarifFeature;

use OpenApi\Annotations as OA;

/**
 * @OA\Put(
 *     path="/api/tarif-features/{id}",
 *     summary="Mettre à jour une caractéristique de tarif",
 *     description="Met à jour le nom ou le tarif associé d'une feature existante.",
 *     tags={"Tarif Features"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID du TarifFeature",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"name"},
 *
 *             @OA\Property(property="name", type="string", example="Support Premium 24/7")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="TarifFeature mis à jour",
 *
 *         @OA\JsonContent(ref="#/components/schemas/TarifFeatureResource")
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="TarifFeature non trouvé",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="TarifFeature not found"))
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
class TarifFeatureUpdateControllerDoc {}
