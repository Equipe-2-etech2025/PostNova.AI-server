<?php

namespace App\OpenApi\Schemas\CampaignFeatures;

/**
 * @OA\Schema(
 *     schema="CampaignFeaturesResource",
 *     type="object",
 *     title="Campaign Features Resource",
 *
 *     @OA\Property(property="id", type="integer", example=1),
 *     @OA\Property(property="campaign_id", type="integer", example=10),
 *     @OA\Property(property="feature_id", type="integer", example=3)
 * )
 */
class CampaignFeaturesResource {}
