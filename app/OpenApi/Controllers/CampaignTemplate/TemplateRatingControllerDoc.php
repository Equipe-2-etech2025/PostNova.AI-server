<?php

namespace App\OpenApi\Controllers\CampaignTemplate;

/**
 * @OA\Post(
 *     path="/api/campaign-templates/{templateId}/rating",
 *     summary="Ajouter ou mettre à jour le rating d'un template",
 *     description="Permet à un utilisateur de créer ou modifier son rating pour un template donné.",
 *     tags={"Campaign Templates"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="templateId",
 *         in="path",
 *         required=true,
 *         description="ID du template",
 *
 *         @OA\Schema(type="integer", example=7)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="rating", type="number", example=4.5)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Rating enregistré avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": true,
 *                 "message": "Rating enregistré avec succès",
 *                 "data": {"template_id": 7, "user_id": 12, "rating": 4.5}
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Requête invalide",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse",
 *             example={"success": false, "message": "Rating invalide ou manquant"})
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
 *         @OA\JsonContent(ref="#/components/schemas/Error401")
 *      ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erreur de validation des champs",
 *
 *         @OA\JsonContent(
 *             type="object",
 *             example={
 *                 "success": false,
 *                 "message": "Les données fournies sont invalides.",
 *                 "errors": {
 *                     "rating": {"Le champ rating doit être un nombre entre 0 et 5."}
 *                 }
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error401")
 *     )
 * )
 */
class TemplateRatingControllerDoc {}
