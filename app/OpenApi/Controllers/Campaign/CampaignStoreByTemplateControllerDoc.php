<?php

namespace App\OpenApi\Controllers\Campaign;

/**
 * @OA\Post(
 *     path="/api/campaigns/template",
 *     summary="Créer une campagne à partir d'un template",
 *     description="Crée une nouvelle campagne en utilisant un template existant et crée éventuellement des social posts associés.",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\RequestBody(
 *         required=true,
 *         description="Données nécessaires pour créer la campagne avec template",
 *
 *         @OA\JsonContent(
 *             required={"name", "description", "type_campaign_id", "template_id"},
 *
 *             @OA\Property(property="name", type="string", maxLength=255, example="Nouvelle campagne avec template"),
 *             @OA\Property(property="description", type="string", maxLength=1000, example="Description complète de la campagne"),
 *             @OA\Property(property="type_campaign_id", type="integer", example=2),
 *             @OA\Property(property="template_id", type="integer", example=5),
 *             @OA\Property(property="status", type="string", nullable=true, example="created"),
 *             @OA\Property(property="is_published", type="boolean", example=false),
 *             @OA\Property(
 *                 property="social_posts",
 *                 type="array",
 *                 description="Liste optionnelle de posts sociaux à créer avec la campagne",
 *
 *                 @OA\Items(
 *                     type="object",
 *
 *                     @OA\Property(property="content", type="string", example="Contenu du post social"),
 *                     @OA\Property(property="social", type="object",
 *                         @OA\Property(property="id", type="integer", example=1)
 *                     )
 *                 )
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=201,
 *         description="Campagne créée avec succès",
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
 *         response=400,
 *         description="Requête invalide",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error400"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=401,
 *         description="Utilisateur non authentifié",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error401"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=403,
 *         description="Accès interdit",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error403"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse",
 *             example={
 *                 "success": false,
 *                 "message": "Les données fournies sont invalides",
 *                 "errors": {
 *                     "name": {"Le nom de la campagne est obligatoire."},
 *                     "description": {"La description est obligatoire."}
 *                 }
 *             }
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error500"
 *         )
 *     )
 * )
 */
class CampaignStoreByTemplateControllerDoc {}
