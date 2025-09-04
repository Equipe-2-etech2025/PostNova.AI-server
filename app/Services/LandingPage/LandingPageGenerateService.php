<?php

namespace App\Services\LandingPage;

use App\DTOs\LandingPage\LandingPageDto;
use App\Models\Campaign;
use App\Repositories\CampaignRepository;
use App\Repositories\LandingPageRepository;
use App\Repositories\PromptRepository;
use Illuminate\Http\Client\ConnectionException;
use Illuminate\Http\Client\RequestException;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LandingPageGenerateService
{
    private array $sectionSpecs = [
        'hero' => [
            'title_limit' => 100,
            'subtitle_limit' => 200,
            'button_text_limit' => 30,
            'url_limit' => 200,
        ],
        'text-section' => [
            'title_limit' => 60,
            'text_limit' => 300,
        ],
        'cta-section' => [
            'title_limit' => 60,
            'text_limit' => 300,
            'button_text_limit' => 30,
            'url_limit' => 200,
        ],
        'columns-section' => [
            'column_title_limit' => 60,
            'column_text_limit' => 300,
        ],
        'footer' => [
            'text_limit' => 200,
        ],
        'sectionMaxCount' => 3,
    ];

    public function __construct(
        private readonly LandingPageRepository $landingPageRepository,
        private readonly CampaignRepository $campaignRepository,
        private readonly PromptRepository $promptRepository
    ) {}

    public function generate(array $params): array
    {
        try {
            $response = $this->generateLandingPage($params);
            $rawContent = $response['candidates'][0]['content']['parts'][0]['text'] ?? '';

            if (! $rawContent) {
                throw new \RuntimeException('Generated content is empty');
            }

            $parsedContent = $this->parseResponseContent($rawContent);

            if (empty($parsedContent['template']['html'])) {
                Log::error('Parsed HTML content is empty', ['parsed_content' => $parsedContent]);
                throw new \RuntimeException('Parsed HTML content is empty');
            }

            if (! $parsedContent) {
                Log::error('Failed to parse generated content');
                throw new \RuntimeException('Failed to parse generated content');
            }

            $dto = new LandingPageDto(
                id: null,
                content: $parsedContent,
                campaign_id: $params['campaign_id']
            );

            $this->landingPageRepository->create($dto);

            return $dto->toArray();
        } catch (\Exception $e) {
            Log::error('LandingPage generation failed', [
                'error' => $e->getMessage(),
            ]);

            return $this->generateFallback($params);
        }
    }

    private function generateLandingPage(array $params): array
    {
        $startTime = microtime(true);

        try {
            $campaign = $this->campaignRepository->find($params['campaign_id']);
            $currentPrompt = $this->promptRepository->find($params['prompt_id']);
            if (!$campaign) {
                throw new \InvalidArgumentException('Invalid campaign ID');
            }

            if (!$currentPrompt) {
                throw new \InvalidArgumentException('Invalid prompt ID');
            }

            $prompt = $this->buildPrompt($params['prompt'], $campaign);

            $startTime = microtime(true);

            $response = Http::timeout(120)
                ->connectTimeout(30)
                ->retry(3, 2000)
                ->post(config('services.gemini.api_url') . '?key=' . config('services.gemini.api_key'), [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => ['maxOutputTokens' => 10000],
                ]);

            $endTime = microtime(true);
            $duration = round(($endTime - $startTime) * 1000, 2);

            if (! $response->successful()) {
                Log::error('API request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                    'duration_ms' => $duration,
                ]);
                throw new \RuntimeException("API request failed with status: {$response->status()}");
            }

            return $response->json();
        } catch (ConnectionException $e) {
            $endTime = microtime(true);
            $duration = round(($endTime - $startTime) * 1000, 2);

            throw new \RuntimeException('API connection timeout after ' . $duration . 'ms');
        } catch (RequestException $e) {
            $endTime = microtime(true);
            $duration = round(($endTime - $startTime) * 1000, 2);

            Log::error('API request exception', [
                'duration_ms' => $duration,
                'error' => $e->getMessage(),
                'response' => $e->response ? $e->response->body() : null,
            ]);

            throw new \RuntimeException('API request failed: ' . $e->getMessage());
        }
    }

    private function buildPrompt(string $topic, Campaign $campaign): string
    {
        $context = $campaign->description;

        return <<<PROMPT
Génère le contenu d'une landing page moderne pour le contexte suivant en français.
Thème principal: "$context"
Topic: "$topic"

IMPORTANT: Génère uniquement du HTML pur avec tous les styles CSS intégrés dans des balises <style> dans le <head>. N'utilise AUCUNE librairie CSS externe ou JavaScript. Tout doit être autonome.

Structure attendue:
- Hero: titre (max {$this->sectionSpecs['hero']['title_limit']}), sous-titre (max {$this->sectionSpecs['hero']['subtitle_limit']}), bouton (max {$this->sectionSpecs['hero']['button_text_limit']}), url (max {$this->sectionSpecs['hero']['url_limit']}), image de fond (url)
- Sections (max {$this->sectionSpecs['sectionMaxCount']}):
    - text-section: titre (max {$this->sectionSpecs['text-section']['title_limit']}), texte (max {$this->sectionSpecs['text-section']['text_limit']})
    - cta-section: titre, texte, bouton, url
    - columns-section: titre, colonnes (titre, texte)
- Footer: texte (max {$this->sectionSpecs['footer']['text_limit']}), liens (texte, url)

Directives pour le HTML:
1. Document HTML complet avec DOCTYPE, head et body
2. Design responsive avec media queries
3. Couleurs modernes et harmonieuses adaptées au contexte
4. Typographie claire et lisible
5. Pas de JavaScript, pas de librairies externes
6. Images d'Unsplash uniquement
7. Boutons avec effets hover en CSS pur
8. Sans commentaire HTML
9. Le <style> ne doit pas etre trop long

IMPORTANT - FORMAT DU HTML:
Dans le HTML, utilise des placeholders sous forme d'objets pour tout le contenu dynamique :
- Titres hero: \${hero.title}
- Sous-titre hero: \${hero.subtitle}
- Bouton hero: \${hero.cta.text}
- Lien hero: \${hero.cta.link}
- Image hero: \${hero.backgroundImage}
- Couleur hero: \${hero.backgroundColor}
- Titre section: \${sections[0].title}, \${sections[1].title}, etc.
- Texte section: \${sections[0].text}, \${sections[1].text}, etc.
- Couleur section: \${sections[0].backgroundColor}, etc.
- Bouton CTA: \${sections[X].cta.text} et \${sections[X].cta.link}
- Colonnes: \${sections[X].columns[0].title}, \${sections[X].columns[0].text}, etc.
- Footer: \${footer.text}
- Liens footer: \${footer.links[0].text}, \${footer.links[0].link}, etc.


Format de réponse STRICT (respecte exactement ce format):

IMPORTANT: N'utilise PAS les balises de code markdown (``` ou ```) dans ta réponse. Utilise uniquement le format ci-dessous.

HTML: `<!DOCTYPE html><html><head><style>/* Tous les styles CSS ici */</style></head><body><!-- Contenu HTML complet --></body></html>`

HERO:
{
  "title": "Titre accrocheur",
  "subtitle": "Sous-titre descriptif",
  "cta": {"text": "Bouton", "link": "https://example.com"},
  "backgroundImage": "https://images.unsplash.com/photo-example",
  "backgroundColor": "#E41B17"
}

SECTIONS:
[
  {
    "id": 1,
    "type": "text-section",
    "title": "Titre section",
    "text": "Contenu de la section",
    "backgroundColor": "#FFFFFF"
  }
]

FOOTER:
{
  "text": "© 2025",
  "links": [{"text": "Mentions légales", "link": "#"}]
}

Respecte les limites de caractères et génère du contenu adapté au contexte. Assure-toi que chaque bloc JSON est valide et bien formé. Le HTML doit être fonctionnel et auto-suffisant.
Max of your thoughtsTokenCount must be 4096
PROMPT;
    }

    private function parseResponseContent(string $content): array
    {
        // Extraire le HTML du bloc de code markdown
        $html = $this->extractHtmlBlock($content);

        // Extraire les blocs JSON
        $hero = $this->extractJsonBlock($content, 'HERO');
        $sections = $this->extractJsonBlock($content, 'SECTIONS');
        $footer = $this->extractJsonBlock($content, 'FOOTER');

        // Log pour déboguer le parsing
        Log::info('Parsed content blocks', [
            'html_length' => strlen($html),
            'hero_found' => $hero !== null,
            'sections_found' => $sections !== null,
            'footer_found' => $footer !== null,
            'html_preview' => substr($html, 0, 200) . '...',
        ]);

        return [
            'template' => [
                'html' => $html,
                'data' => [
                    'hero' => $hero,
                    'sections' => $sections,
                    'footer' => $footer,
                ],
            ],
        ];
    }

    private function extractHtmlBlock(string $content): string
    {
        // Cas 1: HTML: `...` (backticks)
        if (preg_match('/HTML:\s*`([^`]+)`/s', $content, $matches)) {
            $html = $matches[1];
            $decodedHtml = json_decode('"' . $html . '"');
            if ($decodedHtml !== null) {
                $decodedHtml = str_replace('\\\\', '\\', $decodedHtml);
                $decodedHtml = str_replace('\\"', '"', $decodedHtml);
                return trim($decodedHtml);
            }
            $html = str_replace(['\\u003c', '\\u003e', '\\n', '\\"', '\\/', '\\\\'], ['<', '>', "\n", '"', '/', '\\'], $html);
            return trim($html);
        }

        // Cas 2: HTML: "..." (guillemets doubles)
        if (preg_match('/HTML:\s*"([^"]+)"/s', $content, $matches)) {
            $html = $matches[1];
            $html = str_replace(['\\"', '\\n', '\\/', '\\\\'], ['"', "\n", '/', '\\'], $html);
            return trim($html);
        }

        // Cas 3: HTML: '''...''' (guillemets triples)
        if (preg_match("/HTML:\s*'''([\s\S]+?)'''/s", $content, $matches)) {
            $html = $matches[1];
            $html = str_replace(['\\"', '\\n', '\\/', '\\\\'], ['"', "\n", '/', '\\'], $html);
            return trim($html);
        }

        // Cas 4: HTML: <...> (direct sans délimiteur)
        if (preg_match('/HTML:\s*(<!DOCTYPE html>[\s\S]+)/i', $content, $matches)) {
            $html = $matches[1];
            return trim($html);
        }

        // Cas 5: Bloc HTML sans préfixe strict (fallback)
        if (preg_match('/<!DOCTYPE html>[\s\S]+?<\/html>/i', $content, $matches)) {
            return trim($matches[0]);
        }

        // Cas 6: HTML dans un bloc markdown (rare)
        if (preg_match('/```html([\s\S]+?)```/i', $content, $matches)) {
            return trim($matches[1]);
        }

        // Cas 7: HTML dans un bloc code sans balise (rare)
        if (preg_match('/```([\s\S]+?)```/i', $content, $matches)) {
            return trim($matches[1]);
        }

        // Cas 8: Recherche d'une balise <html> dans tout le contenu
        if (preg_match('/<!DOCTYPE html>[\s\S]+?<\/html>/i', $content, $matches)) {
            return trim($matches[0]);
        }

        // Si rien trouvé, log le contenu pour debug
        Log::warning('Aucun bloc HTML trouvé dans le contenu généré', [
            'content_preview' => substr($content, 0, 500) . '...'
        ]);
        return '';
    }

    private function extractJsonBlock(string $content, string $blockName): ?array
    {
        $pattern = '/' . preg_quote($blockName) . ':\s*(\{[\s\S]*?\}|\[[\s\S]*?\])\s*(?=\n[A-Z]+:|$)/';

        if (preg_match($pattern, $content, $matches)) {
            $jsonString = trim($matches[1]);

            try {
                $decoded = json_decode($jsonString, true, 512, JSON_THROW_ON_ERROR);

                return $decoded;
            } catch (\JsonException $e) {
                Log::error("Failed to parse JSON for {$blockName}", [
                    'json_string' => $jsonString,
                    'error' => $e->getMessage(),
                ]);

                return null;
            }
        }

        return null;
    }

    private function generateFallback(array $params): array
    {
        $fallbackHtml = '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Landing Page</title>
    <style>
        * { margin: 0; padding: 0; box-sizing: border-box; }
        body { font-family: Arial, sans-serif; line-height: 1.6; }
        .hero { background: ${hero.backgroundColor}; color: white; padding: 80px 20px; text-align: center; }
        .hero h1 { font-size: 3rem; margin-bottom: 20px; }
        .hero p { font-size: 1.2rem; margin-bottom: 30px; }
        .btn { display: inline-block; background: #fff; color: #333; padding: 15px 30px; text-decoration: none; border-radius: 5px; font-weight: bold; }
        .btn:hover { background: #f0f0f0; }
        .footer { background: #333; color: white; text-align: center; padding: 40px 20px; }
    </style>
</head>
<body>
    <section class="hero">
        <h1>${hero.title}</h1>
        <p>${hero.subtitle}</p>
        <a href="${hero.cta.link}" class="btn">${hero.cta.text}</a>
    </section>
    <footer class="footer">
        <p>${footer.text}</p>
    </footer>
</body>
</html>';

        $fallbackData = [
            'hero' => [
                'title' => 'Bienvenue',
                'subtitle' => 'Découvrez nos produits et services',
                'cta' => ['text' => 'En savoir plus', 'link' => 'https://example.com'],
                'backgroundImage' => '',
                'backgroundColor' => $params['colors']['primary'] ?? '#E41B17',
            ],
            'sections' => [],
            'footer' => [
                'text' => '© ' . date('Y'),
                'links' => [],
            ],
        ];

        // Créer un DTO avec le fallback
        $dto = new LandingPageDto(
            id: null,
            content: [
                'template' => [
                    'html' => $fallbackHtml,
                    'data' => $fallbackData,
                ],
            ],
            campaign_id: $params['campaign_id']
        );

        // Sauvegarder le fallback en base
        try {
            $this->landingPageRepository->create($dto);
        } catch (\Exception $e) {
            Log::warning('Failed to save fallback landing page', ['error' => $e->getMessage()]);
        }

        return $dto->toArray();
    }
}
