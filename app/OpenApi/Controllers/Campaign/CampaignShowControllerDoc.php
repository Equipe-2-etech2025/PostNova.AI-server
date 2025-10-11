<?php

namespace App\OpenApi\Controllers\Campaign;

/**
 * @OA\Get(
 *     path="/api/campaigns/{id}",
 *     summary="Afficher une campagne",
 *     description="Retourne les détails d'une campagne spécifique par son ID.",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID de la campagne",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=1)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Détails de la campagne récupérés avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(
 *                 property="data",
 *                 ref="#/components/schemas/CampaignResource"
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error401")
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Non autorisé à accéder à cette ressource",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error403")
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Campagne introuvable",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error400")
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error500")
 *     )
 * )
 */
class CampaignShowControllerDoc {}
