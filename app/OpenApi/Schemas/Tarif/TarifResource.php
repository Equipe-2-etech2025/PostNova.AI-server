<?php

namespace App\OpenApi\Schemas\Tarif;

/**
 * @OA\Schema(
 *     schema="TarifResource",
 *     type="object",
 *     description="Représente un tarif",
 *
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         description="ID du tarif",
 *         example=1
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         description="Nom du tarif",
 *         example="Pro"
 *     ),
 *     @OA\Property(
 *         property="amount",
 *         type="number",
 *         format="float",
 *         description="Montant du tarif",
 *         example=29.99
 *     ),
 *     @OA\Property(
 *         property="max_limit",
 *         type="integer",
 *         description="Limite maximale associée au tarif",
 *         example=50
 *     )
 * )
 */
class TarifResource {}
