<?php

namespace App\OpenApi\Controllers\CampaignInteraction;

/**
 * @OA\Post(
 *     path="/api/campaign-interactions/dislike",
 *     summary="Supprimer une interaction par campagne et utilisateur",
 *     description="Supprime une interaction spécifique associée à un utilisateur et une campagne.
 *     Cette opération nécessite que la combinaison (campaign_id, user_id) existe.",
 *     tags={"Campaign Interactions"},
 *
 *     @OA\RequestBody(
 *         required=true,
 *         @OA\JsonContent(
 *             type="object",
 *             required={"campaign_id", "user_id"},
 *             @OA\Property(
 *                 property="campaign_id",
 *                 type="integer",
 *                 description="Identifiant de la campagne",
 *                 example=12
 *             ),
 *             @OA\Property(
 *                 property="user_id",
 *                 type="integer",
 *                 description="Identifiant de l’utilisateur",
 *                 example=45
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Interaction supprimée avec succès",
 *         @OA\JsonContent(
 *             type="object",
 *             example={"success": true, "message": "Interaction supprimée avec succès"}
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=404,
 *         description="Aucune interaction trouvée pour ce couple campaign_id / user_id",
 *         @OA\JsonContent(
 *             type="object",
 *             example={"success": false, "message": "Aucune interaction trouvée pour ce couple campaign_id / user_id"}
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Requête invalide (paramètres manquants ou invalides)",
 *         @OA\JsonContent(
 *             type="object",
 *             example={"success": false, "error": "Le champ campaign_id est requis et doit être un entier valide"}
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *         @OA\JsonContent(
 *             type="object",
 *             example={"success": false, "error": "Unauthenticated"}
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès refusé",
 *         @OA\JsonContent(
 *             type="object",
 *             example={"success": false, "error": "Vous n’avez pas la permission de supprimer cette interaction"}
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur interne du serveur",
 *         @OA\JsonContent(
 *             type="object",
 *             example={"success": false, "error": "Erreur interne du serveur, veuillez réessayer plus tard"}
 *         )
 *     )
 * )
 */
class CampaignInteractionDestroyByCampaignAndUserControllerDoc {}
