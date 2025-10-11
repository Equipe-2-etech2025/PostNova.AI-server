<?php

namespace App\OpenApi\Controllers\CampaignInteraction;

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
 *
 *         @OA\Schema(type="integer", example=101)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Interaction supprimée avec succès",
 *
 *         @OA\JsonContent(example={"message": "Interaction supprimée avec succès"})
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Interaction non trouvée",
 *
 *         @OA\JsonContent(example={"error": "Aucune interaction trouvée avec cet identifiant"})
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(example={"error": "Unauthenticated"})
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *
 *         @OA\JsonContent(example={"error": "Vous n’avez pas la permission de supprimer cette interaction"})
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *
 *         @OA\JsonContent(example={"error": "Erreur interne du serveur, veuillez réessayer plus tard"})
 *     )
 * )
 */
class CampaignInteractionDestroyControllerDoc {}
