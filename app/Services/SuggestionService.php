<?php

namespace App\Services;

use App\Services\Interfaces\SuggestionServiceInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class SuggestionService implements SuggestionServiceInterface
{
    protected CampaignService $campaignService;

    protected PromptService $promptService;

    protected TarifUserService $tarifUserService;

    public function __construct(
        CampaignService $campaignService,
        PromptService $promptService,
        TarifUserService $tarifUserService
    ) {
        $this->campaignService = $campaignService;
        $this->promptService = $promptService;
        $this->tarifUserService = $tarifUserService;
    }

    public function getSuggestions(int $userId): array
    {
        try {
            $campaigns = $this->campaignService->getCampaignsByUserId($userId);
            $quotaUsed = $this->promptService->countTodayPromptsByUser($userId);
            $tarifUser = $this->tarifUserService->getLatestByUserId($userId);

            $prompt = $this->buildPrompt($campaigns, $quotaUsed, $tarifUser);

            $response = Http::post(
                'https://generativelanguage.googleapis.com/v1beta/models/gemini-2.0-flash:generateContent?key='.env('GEMINI_API_KEY'),
                [
                    'contents' => [[
                        'parts' => [['text' => $prompt]],
                    ]],
                ]
            );

            if (! $response->successful()) {
                Log::error('Gemini API error', ['response' => $response->body()]);

                return $this->getFallbackSuggestions();
            }

            $textResponse = $response->json('candidates.0.content.parts.0.text');
            $json = $this->cleanAndParseJson($textResponse);

            return $json['suggestions'] ?? $this->getFallbackSuggestions();
        } catch (\Exception $e) {
            Log::error('Erreur getSuggestions: '.$e->getMessage());

            return $this->getFallbackSuggestions();
        }
    }

    private function buildPrompt($campaigns, int $quotaUsed, $tarifUser): string
    {
        $latest = $campaigns->first();

        $tarifName = $tarifUser->tarif->name ?? 'Aucun';
        $tarifMax = $tarifUser->tarif->max_limit ?? 0;
        $latestLikes = $latest?->total_likes ?? 0;
        $latestCreatedAt = $latest?->created_at ?? 'Jamais';

        $campaignLines = $campaigns->map(function ($c) {
            return "- {$c->name}: {$c->total_likes} j'aime, {$c->total_views} vues";
        })->implode("\n");

        return <<<EOT
Analyse les données suivantes d'un utilisateur de plateforme marketing et génère exactement 3 conseils personnalisés au format JSON.

DONNÉES UTILISATEUR:
- Nombre total de campagnes: {$campaigns->count()}
- Engagement total (j'aime): {$latestLikes}
- Plan actuel: {$tarifName}
- Quota utilisé aujourd'hui: {$quotaUsed}
- Dernière campagne crée: {$latestCreatedAt}

DERNIÈRES CAMPAGNES:
{$campaignLines}

INSTRUCTIONS:
Génère exactement 3 conseils personnalisés basés sur ces données. Chaque conseil doit être actionnable et spécifique à la situation de l'utilisateur.

Format de réponse JSON attendu:
{
  "suggestions": [
    {
      "id": "suggestion_1",
      "title": "Titre court et accrocheur",
      "content": "Description détaillée du conseil (max 120 caractères)",
      "type": "improvement|congratulation|reminder|upgrade|tip",
      "priority": "high|medium|low",
      "iconType": "trending|award|clock|trophy|lightbulb|rocket|target",
      "hasAction": true/false,
      "actionText": "Texte du bouton (si hasAction: true)"
    }
  ]
}

Réponds UNIQUEMENT avec le JSON, sans texte supplémentaire.
EOT;
    }

    private function cleanAndParseJson(string $text): array
    {
        $clean = trim(str_replace(['```json', '```'], '', $text));

        return json_decode($clean, true);
    }

    private function getFallbackSuggestions(): array
    {
        return [
            [
                'id' => 'fallback_1',
                'title' => 'Publiez régulièrement',
                'content' => 'Restez visible avec des campagnes fréquentes',
                'type' => 'tip',
                'priority' => 'medium',
                'iconType' => 'lightbulb',
                'hasAction' => false,
            ],
            [
                'id' => 'fallback_2',
                'title' => 'Créez une campagne',
                'content' => 'Lancez une nouvelle campagne pour booster votre audience',
                'type' => 'reminder',
                'priority' => 'high',
                'iconType' => 'rocket',
                'hasAction' => true,
                'actionText' => 'Créer une campagne',
            ],
            [
                'id' => 'fallback_3',
                'title' => 'Analysez vos stats',
                'content' => 'Consultez vos données pour améliorer vos performances',
                'type' => 'improvement',
                'priority' => 'low',
                'iconType' => 'bar-chart',
                'hasAction' => false,
            ],
        ];
    }
}
