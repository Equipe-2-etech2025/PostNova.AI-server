<?php

namespace App\OpenApi\Controllers\TypeCampaign;

use OpenApi\Annotations as OA;

/**
 * @OA\Get(
 *     path="/api/type-campaigns/search",
 *     summary="Récupère les TypeCampaign selon des critères",
 *     description="Retourne une liste de TypeCampaign filtrée selon les critères passés en query. Si l'utilisateur n'est pas admin, filtrage automatique par user_id.",
 *     tags={"TypeCampaigns"},
 *
 *     @OA\Parameter(
 *         name="name",
 *         in="query",
 *         required=false,
 *         description="Filtre par nom du type de campagne",
 *
 *         @OA\Schema(type="string", example="Marketing")
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Liste des TypeCampaign récupérée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(
 *                 property="data",
 *                 type="array",
 *
 *                 @OA\Items(ref="#/components/schemas/TypeCampaignResource")
 *             )
 *         )
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
 *         @OA\JsonContent(@OA\Property(property="message", type="string", example="Une erreur est survenue lors de la récupération des TypeCampaign"))
 *     )
 * )
 */
class TypeCampaignCriteriaControllerDoc {}
