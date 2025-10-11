<?php

namespace App\OpenApi\Schemas\CampaignInteraction;

/**
 * @OA\Schema(
 *     schema="CampaignInteractionResource",
 *     type="object",
 *     title="Campaign Interaction",
 *     description="Représentation d'une interaction utilisateur avec une campagne",
 *
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=101
 *     ),
 *     @OA\Property(
 *         property="campaign_id",
 *         type="integer",
 *         example=12,
 *         description="Identifiant de la campagne"
 *     ),
 *     @OA\Property(
 *         property="user_id",
 *         type="integer",
 *         example=45,
 *         description="Identifiant de l’utilisateur ayant interagi"
 *     ),
 *     @OA\Property(
 *         property="type",
 *         type="string",
 *         example="like",
 *         description="Type d’interaction (view, like, share…)"
 *     ),
 *     @OA\Property(
 *         property="views",
 *         type="integer",
 *         example=5,
 *         description="Nombre de vues associées"
 *     ),
 *     @OA\Property(
 *         property="likes",
 *         type="integer",
 *         example=1,
 *         description="Nombre de likes associés"
 *     ),
 *     @OA\Property(
 *         property="shares",
 *         type="integer",
 *         example=0,
 *         description="Nombre de partages associés"
 *     ),
 *     @OA\Property(
 *         property="created_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-09-25T12:34:56Z"
 *     ),
 *     @OA\Property(
 *         property="updated_at",
 *         type="string",
 *         format="date-time",
 *         example="2025-09-25T14:12:00Z"
 *     )
 * )
 */
class CampaignInteractionResource {}

/**
 * @OA\Schema(
 *     schema="CampaignInteractionMeta",
 *     type="object",
 *     title="Campaign Interaction Meta",
 *     description="Métadonnées globales sur les interactions d'une campagne",
 *
 *     @OA\Property(
 *         property="total_interactions",
 *         type="integer",
 *         example=50,
 *         description="Nombre total d’interactions"
 *     ),
 *     @OA\Property(
 *         property="total_views",
 *         type="integer",
 *         example=120,
 *         description="Nombre total de vues"
 *     ),
 *     @OA\Property(
 *         property="total_likes",
 *         type="integer",
 *         example=30,
 *         description="Nombre total de likes"
 *     ),
 *     @OA\Property(
 *         property="total_shares",
 *         type="integer",
 *         example=10,
 *         description="Nombre total de partages"
 *     )
 * )
 */
class CampaignInteractionMetaSchema {}
