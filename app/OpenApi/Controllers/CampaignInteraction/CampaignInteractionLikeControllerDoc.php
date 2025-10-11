<?php

namespace App\OpenApi\Controllers\CampaignInteraction;

/**
 * @OA\Post(
 *     path="/api/campaign-interactions/{interactionId}/like",
 *     summary="Ajouter un like à une interaction",
 *     description="Incrémente le compteur de likes pour une interaction spécifique.",
 *     tags={"Campaign Interactions"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="interactionId",
 *         in="path",
 *         description="Identifiant de l'interaction",
 *         required=true,
 *
 *         @OA\Schema(type="integer", example=101)
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Like ajouté avec succès",
 *
 *         @OA\JsonContent(type="object", example={"message": "Like ajouté avec succès"})
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Requête invalide",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error400")
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
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": false,
 *                 "message": "Impossible d'ajouter un like",
 *                 "errors": {
 *                     "interactionId": {"L'identifiant fourni est invalide."}
 *                 }
 *             }
 *         )
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
class CampaignInteractionLikeControllerDoc {}
