<?php

namespace App\Services\CampaignCreateService;

use App\Services\Interfaces\CampagnGenerateInterface\CampaignNameGeneratorServiceInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CampaignNameGeneratorService implements CampaignNameGeneratorServiceInterface
{
    public function generateFromDescription(string $description, string $campaignType): string
    {
        try {
            $response = Http::withHeaders([
                'Content-Type' => 'application/json',
            ])
                ->timeout(30)
                ->post('https://generativelanguage.googleapis.com/v1beta/models/gemini-2.5-flash:generateContent?key='.config('services.gemini.api_key'), [
                    'contents' => [
                        'parts' => [
                            ['text' => $this->buildPrompt($description, $campaignType)],
                        ],
                    ],
                ]);

            if ($response->successful()) {
                $data = $response->json();

                return $this->cleanResponse($data['candidates'][0]['content']['parts'][0]['text']);
            }

            return $this->generateFallbackName($description, $campaignType);

        } catch (\Exception $e) {
            Log::error('Gemini API exception', ['error' => $e->getMessage()]);

            return $this->generateFallbackName($description, $campaignType);
        }
    }

    protected function buildPrompt(string $description, string $campaignType): string
    {
        return "Génère un nom professionnel pour une campagne marketing de type '$campaignType' basée sur: '$description'.
                Le nom doit être :
                - Maximum 10 mots
                - Accrocheur et mémorable
                - Adapté au type de campagne $campaignType
                Réponds uniquement avec le nom généré, sans guillemets.";
    }

    protected function cleanResponse(string $response): string
    {
        return trim(str_replace(['"', 'Nom :'], '', $response));
    }

    protected function generateFallbackName(string $description, string $campaignType): string
    {
        $keywords = ['Innovation', 'Excellence', 'Future', 'Projet', 'Solution'];
        $randomKeyword = $keywords[array_rand($keywords)];

        return 'Campagne '.$campaignType.' '.$randomKeyword.' '.date('Y');
    }
}
