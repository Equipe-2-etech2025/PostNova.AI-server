<?php

namespace App\OpenApi\Controllers\TarifUser;

use OpenApi\Annotations as OA;

/**
 * @OA\Post(
 *     path="/api/tarif-users",
 *     summary="Créer un nouveau TarifUser",
 *     description="Crée un TarifUser pour un utilisateur",
 *     tags={"TarifUsers"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             required={"tarif_id","user_id"},
 *
 *             @OA\Property(property="tarif_id", type="integer", example=2),
 *             @OA\Property(property="user_id", type="integer", example=5),
 *             @OA\Property(property="expired_at", type="string", format="date-time", example="2025-10-25 12:00")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="TarifUser créé avec succès",
 *
 *         @OA\JsonContent(ref="#/components/schemas/TarifUserResource")
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
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Le tarif_id est requis"))
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Une erreur est survenue lors de la création"))
 *     )
 * )
 */
class TarifUserStoreControllerDoc {}
