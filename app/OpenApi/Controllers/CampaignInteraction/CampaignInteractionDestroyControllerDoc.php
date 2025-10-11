<?php

namespace App\OpenApi\Controllers\CampaignInteraction;

use OpenApi\Annotations as OA;

/**
 * @OA\Delete(
 *     path="/api/campaign-interactions/{id}",
 *     summary="Supprimer une interaction par ID",
 *     description="Supprime une interaction spécifique grâce à son identifiant unique.",
 *     tags={"Campaign Interactions"},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="Identifiant de l’interaction",
 *         required=true,
 *         @OA\Schema(type="integer", example=101)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Interaction supprimée avec succès",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(property="message", type="string", example="Interaction supprimée avec succès")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Interaction non trouvée",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="error", type="string", example="Aucune interaction trouvée avec cet identifiant")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="error", type="string", example="Unauthenticated")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="error", type="string", example="Vous n’avez pas la permission de supprimer cette interaction")
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="success", type="boolean", example=false),
 *             @OA\Property(property="error", type="string", example="Erreur interne du serveur, veuillez réessayer plus tard")
 *         )
 *     )
 * )
 */
class CampaignInteractionDestroyControllerDoc {}
