<?php

namespace App\OpenApi\Controllers\Campaign;

/**
 * @OA\Put(
 *     path="/api/campaigns/{id}",
 *     summary="Mettre à jour une campagne",
 *     description="Met à jour une campagne existante appartenant à l’utilisateur connecté (ou accessible par un admin).",
 *     tags={"Campaigns"},
 *     security={{"bearerAuth":{}}},
 *
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         required=true,
 *         description="ID de la campagne à mettre à jour",
 *
 *         @OA\Schema(type="integer", example=5)
 *     ),
 *
 *     @OA\RequestBody(
 *         required=true,
 *         description="Données à mettre à jour pour la campagne",
 *
 *         @OA\JsonContent(
 *             required={"name", "description", "type_campaign_id"},
 *
 *             @OA\Property(property="name", type="string", maxLength=255, example="Nom mis à jour de la campagne"),
 *             @OA\Property(property="description", type="string", maxLength=1000, example="Nouvelle description de la campagne"),
 *             @OA\Property(property="type_campaign_id", type="integer", example=2),
 *             @OA\Property(property="status", type="string", nullable=true, example="active"),
 *             @OA\Property(property="is_published", type="boolean", example=true),
 *             @OA\Property(
 *                 property="social_posts",
 *                 type="array",
 *                 description="Liste optionnelle de posts associés",
 *
 *                 @OA\Items(type="string", example="Contenu modifié d’un post social")
 *             )
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=200,
 *         description="Campagne mise à jour avec succès",
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
 *      response=403,
 *      description="Accès interdit",
 *
 *      @OA\JsonContent(
 *          ref="#/components/schemas/Error403"
 *      )
 *  ),
 *
 *     @OA\Response(
 *         response=400,
 *         description="Campagne introuvable",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error400"
 *         )
 *     ),
 *
 *     @OA\Response(
 *         response=422,
 *         description="Erreur de validation",
 *
 *         @OA\JsonContent(ref="#/components/schemas/ErrorResponse",
 *          example={
 *              "success": false,
 *              "message": "Les données fournies sont invalides.",
 *              "errors": {
 *              "name": {"Le nom de la campaign est obligatoire."},
 *              "description": {"La description de la campagne ne dépasse pas 1000 caractères"}
 *          }
 *      })
 *     ),
 *
 *     @OA\Response(
 *         response=500,
 *         description="Erreur serveur",
 *
 *         @OA\JsonContent(ref="#/components/schemas/Error500"
 *     )
 *   )
 * )
 */
class CampaignUpdateControllerDoc {}
