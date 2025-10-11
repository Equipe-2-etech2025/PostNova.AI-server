<?php

namespace App\OpenApi\Controllers\Campaign;

/**
 * @OA\Post(
 *     path="/api/campaigns/generate-name",
 *     summary="Générer une campagne depuis une description",
 *     description="Crée une campagne basée sur la description fournie et retourne la campagne générée.",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\RequestBody(
 *         required=true,
 *         description="Données pour générer la campagne",
 *
 *         @OA\JsonContent(
 *             required={"description","type_campaign_id","user_id"},
 *
 *             @OA\Property(property="description", type="string", example="Nouvelle campagne marketing"),
 *             @OA\Property(property="type_campaign_id", type="integer", example=2),
 *             @OA\Property(property="user_id", type="integer", example=10)
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Campagne générée avec succès",
 *
 *         @OA\JsonContent(
 *             type="object",
 *
 *             @OA\Property(property="success", type="boolean", example=true),
 *             @OA\Property(
 *                 property="campaign",
 *                 type="object",
 *                 description="Campagne générée",
 *                 @OA\Property(property="id", type="integer", example=15),
 *                 @OA\Property(property="name", type="string", example="Campagne générée automatiquement"),
 *                 @OA\Property(property="description", type="string", example="Nouvelle campagne marketing"),
 *                 @OA\Property(property="type_campaign_id", type="integer", example=2),
 *                 @OA\Property(property="user_id", type="integer", example=10),
 *                 @OA\Property(property="status", type="string", example="created"),
 *                 @OA\Property(property="is_published", type="boolean", example=false)
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Requête invalide",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "La requête est invalide ou mal formée",
 *                 "errors": {
 *                     "description": {"Le champ description est obligatoire."},
 *                     "type_campaign_id": {"Type de campagne invalide."}
 *                 }
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Error401"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Les données fournies sont invalides.",
 *                 "errors": {
 *                     "description": {"Le champ description est obligatoire."},
 *                     "user_id": {"Utilisateur inexistant."}
 *                 }
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(
 *             ref="#/components/schemas/Error500"
 *         )
 *     )
 * )
 */
class CampaignGenerateNameControllerDoc {}
