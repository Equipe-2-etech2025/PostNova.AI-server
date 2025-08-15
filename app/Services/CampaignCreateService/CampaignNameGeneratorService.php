<?php

namespace App\Services\CampaignCreateService;

use App\Services\Interfaces\CampaignNameGeneratorServiceInterface;
use Google\Cloud\AIPlatform\V1\Client\PredictionServiceClient;
use Google\Cloud\AIPlatform\V1\Content;
use Google\Cloud\AIPlatform\V1\GenerateContentRequest;
use Google\Cloud\AIPlatform\V1\Part;

class CampaignNameGeneratorService implements CampaignNameGeneratorServiceInterface
{
    public function generateFromDescription(string $description): string
    {
        try {
            $client = new PredictionServiceClient([
                'credentials' => config('services.gemini.key'),
                'apiEndpoint' => 'us-central1-aiplatform.googleapis.com'
            ]);

            $response = $client->generateContent(
                new GenerateContentRequest([
                    'model' => sprintf(
                        'projects/%s/locations/us-central1/publishers/google/models/gemini-pro',
                        config('services.gemini.project_id')
                    ),
                    'contents' => [
                        new Content([
                            'role' => 'user',
                            'parts' => [
                                new Part([
                                    'text' => "Génère un nom de campagne basé sur: $description et mettez toujours aux début de la phrase, Campaigne pour et adapter la suite en fonction la description fournie"
                                ])
                            ]
                        ])
                    ]
                ])
            );

            return $response->getCandidates()[0]->getContent()->getParts()[0]->getText();
        } catch (\Exception $e) {
            logger()->error('Gemini API error', ['error' => $e]);
            return $this->generateFromDescription($description);
        }
    }
}
