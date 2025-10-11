<?php

namespace App\OpenApi\Schemas\CampaignTemplate;

/**
 * @OA\Schema(
 *     schema="CampaignTemplateResource",
 *     type="object",
 *     title="Campaign Template",
 *     description="Représentation d'un modèle de campagne avec ses stats et informations détaillées",
 *
 *     @OA\Property(
 *         property="id",
 *         type="integer",
 *         example=7,
 *         description="Identifiant du template"
 *     ),
 *     @OA\Property(
 *         property="name",
 *         type="string",
 *         example="Template Marketing Automatique",
 *         description="Nom du template"
 *     ),
 *     @OA\Property(
 *         property="description",
 *         type="string",
 *         example="Template pour campagne marketing automatisée",
 *         description="Description du template"
 *     ),
 *     @OA\Property(
 *         property="category",
 *         type="object",
 *         nullable=true,
 *         @OA\Property(property="id", type="integer", example=2),
 *         @OA\Property(property="name", type="string", example="Marketing"),
 *         @OA\Property(property="icon", type="string", example="marketing-icon")
 *     ),
 *     @OA\Property(
 *         property="type",
 *         type="object",
 *         nullable=true,
 *         @OA\Property(property="id", type="integer", example=1),
 *         @OA\Property(property="name", type="string", example="Email Campaign")
 *     ),
 *     @OA\Property(
 *         property="author",
 *         type="string",
 *         example="John Doe",
 *         description="Auteur du template"
 *     ),
 *     @OA\Property(
 *         property="thumbnail",
 *         type="string",
 *         example="https://example.com/thumbnails/template7.png",
 *         description="URL de la miniature du template"
 *     ),
 *     @OA\Property(
 *         property="preview",
 *         type="string",
 *         example="https://example.com/previews/template7.png",
 *         description="URL de l'aperçu du template"
 *     ),
 *     @OA\Property(
 *         property="isPremium",
 *         type="boolean",
 *         example=true,
 *         description="Indique si le template est premium"
 *     ),
 *     @OA\Property(
 *         property="rating",
 *         type="number",
 *         format="float",
 *         example=4.5,
 *         description="Note moyenne du template"
 *     ),
 *     @OA\Property(
 *         property="uses",
 *         type="integer",
 *         example=120,
 *         description="Nombre de fois que le template a été utilisé"
 *     ),
 *     @OA\Property(
 *         property="tags",
 *         type="array",
 *
 *         @OA\Items(type="string"),
 *         example={"marketing", "automation", "email"},
 *         description="Tags associés au template"
 *     ),
 *
 *     @OA\Property(
 *         property="socialPosts",
 *         type="array",
 *
 *         @OA\Items(
 *             type="object",
 *
 *             @OA\Property(property="id", type="integer", example=101),
 *             @OA\Property(property="content", type="string", example="Découvrez notre nouveau produit !"),
 *             @OA\Property(property="created_at", type="string", format="date-time", example="2025-09-25 12:34"),
 *             @OA\Property(
 *                 property="social",
 *                 type="object",
 *                 nullable=true,
 *                 @OA\Property(property="id", type="integer", example=3),
 *                 @OA\Property(property="name", type="string", example="LinkedIn")
 *             )
 *         )
 *     ),
 *     @OA\Property(
 *         property="createdAt",
 *         type="string",
 *         format="date",
 *         example="2025-09-01",
 *         description="Date de création du template"
 *     )
 * )
 */
class CampaignTemplateResource {}
