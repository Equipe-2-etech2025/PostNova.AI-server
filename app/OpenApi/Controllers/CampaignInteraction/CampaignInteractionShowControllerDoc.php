<?php

namespace App\OpenApi\Controllers\CampaignInteraction;

/**
 * @OA\Get(
 *     path="/api/campaign-interactions/{id}",
 *     summary="Afficher une interaction spécifique",
 *     description="Retourne les détails d'une interaction utilisateur avec une campagne.",
 *     tags={"Campaign Interactions"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Identifiant de l'interaction",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=101)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Interaction récupérée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(
 *                 property="data",
 *                 ref="#/components/schemas/CampaignInteractionResource"
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
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error403")
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error500")
 *     )
 * )
 */
class CampaignInteractionShowControllerDoc {}
