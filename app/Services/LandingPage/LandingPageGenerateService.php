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
            if (! $campaign) {
                throw new \InvalidArgumentException('Invalid campaign ID');
            }

            if (! $currentPrompt) {
                throw new \InvalidArgumentException('Invalid prompt ID');
            }

            $prompt = $this->buildPrompt($params['prompt'], $campaign);

            $response = Http::timeout(120)
                ->connectTimeout(30)
                ->retry(3, 2000)
                ->post(config('services.gemini.api_url').'?key='.config('services.gemini.api_key'), [
                    'contents' => [['parts' => [['text' => $prompt]]]],
                    'generationConfig' => ['maxOutputTokens' => 10000],
                ]);

            if (! $response->successful()) {
                Log::error('API request failed', [
                    'status' => $response->status(),
                    'body' => $response->body(),
                ]);
                throw new \RuntimeException("API request failed with status: {$response->status()}");
            }

            return $response->json();
        } catch (ConnectionException $e) {
            $endTime = microtime(true);
            $duration = round(($endTime - $startTime) * 1000, 2);

            throw new \RuntimeException('API connection timeout after '.$duration.'ms');
        } catch (RequestException $e) {
            $endTime = microtime(true);
            $duration = round(($endTime - $startTime) * 1000, 2);

            Log::error('API request exception', [
                'duration_ms' => $duration,
                'error' => $e->getMessage(),
                'response' => $e->response ? $e->response->body() : null,
            ]);

            throw new \RuntimeException('API request failed: '.$e->getMessage());
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
  },
  ...
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

        // Fallbacks par défaut si les blocs ne sont pas trouvés
        if ($hero === null) {
            $hero = [
                'title' => 'Titre par défaut',
                'subtitle' => 'Sous-titre par défaut',
                'cta' => ['text' => 'Cliquez ici', 'link' => '#'],
                'backgroundImage' => '',
                'backgroundColor' => '#E41B17',
            ];
            Log::info('Utilisation du fallback HERO par défaut');
        }

        if ($sections === null) {
            $sections = [
                [
                    'id' => 1,
                    'type' => 'text-section',
                    'title' => 'Section par défaut',
                    'text' => 'Contenu de la section par défaut',
                    'backgroundColor' => '#FFFFFF',
                ],
            ];
            Log::info('Utilisation du fallback SECTIONS par défaut');
        }

        if ($footer === null) {
            $footer = [
                'text' => '© '.date('Y'),
                'links' => [['text' => 'Accueil', 'link' => '#']],
            ];
            Log::info('Utilisation du fallback FOOTER par défaut');
        }

        // Log pour déboguer le parsing
        Log::info('Parsed content blocks', [
            'html_length' => strlen($html),
            'hero_found' => $hero !== null,
            'sections_found' => $sections !== null,
            'footer_found' => $footer !== null,
            'html_preview' => substr($html, 0, 200).'...',
            'hero_preview' => is_array($hero) ? json_encode(array_slice($hero, 0, 2)) : 'null',
            'sections_count' => is_array($sections) ? count($sections) : 0,
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
            $decodedHtml = json_decode('"'.$html.'"');
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
            'content_preview' => substr($content, 0, 500).'...',
        ]);

        return '';
    }

    private function extractJsonBlock(string $content, string $blockName): ?array
    {
        // Cas 1: Format standard avec pattern strict
        $pattern = '/'.preg_quote($blockName).':\s*(\{[\s\S]*?\}|\[[\s\S]*?\])\s*(?=\n[A-Z]+:|$)/';
        if (preg_match($pattern, $content, $matches)) {
            $jsonString = trim($matches[1]);
            $decoded = $this->parseJsonString($jsonString, $blockName);
            if ($decoded !== null) {
                return $decoded;
            }
        }

        // Cas 2: Format avec sauts de ligne supplémentaires
        $pattern = '/'.preg_quote($blockName).':\s*\n+(\{[\s\S]*?\}|\[[\s\S]*?\])/';
        if (preg_match($pattern, $content, $matches)) {
            $jsonString = trim($matches[1]);
            $decoded = $this->parseJsonString($jsonString, $blockName);
            if ($decoded !== null) {
                return $decoded;
            }
        }

        // Cas 3: Format avec guillemets triples autour du JSON
        $pattern = '/'.preg_quote($blockName).':\s*```json\s*(\{[\s\S]*?\}|\[[\s\S]*?\])\s*```/';
        if (preg_match($pattern, $content, $matches)) {
            $jsonString = trim($matches[1]);
            $decoded = $this->parseJsonString($jsonString, $blockName);
            if ($decoded !== null) {
                return $decoded;
            }
        }

        // Cas 4: Format avec backticks simples
        $pattern = '/'.preg_quote($blockName).':\s*`(\{[\s\S]*?\}|\[[\s\S]*?\])`/';
        if (preg_match($pattern, $content, $matches)) {
            $jsonString = trim($matches[1]);
            $decoded = $this->parseJsonString($jsonString, $blockName);
            if ($decoded !== null) {
                return $decoded;
            }
        }

        // Cas 5: Format avec guillemets doubles autour du JSON complet
        $pattern = '/'.preg_quote($blockName).':\s*"(\{[\s\S]*?\}|\[[\s\S]*?\])"/';
        if (preg_match($pattern, $content, $matches)) {
            $jsonString = str_replace('\\"', '"', trim($matches[1]));
            $jsonString = str_replace('\\n', "\n", $jsonString);
            $decoded = $this->parseJsonString($jsonString, $blockName);
            if ($decoded !== null) {
                return $decoded;
            }
        }

        // Cas 6: Recherche flexible - bloc JSON après le nom sans délimiteurs stricts
        $pattern = '/'.preg_quote($blockName).'\s*:?\s*(\{[^{}]*(?:\{[^{}]*\}[^{}]*)*\}|\[[^\[\]]*(?:\[[^\[\]]*\][^\[\]]*)*\])/';
        if (preg_match($pattern, $content, $matches)) {
            $jsonString = trim($matches[1]);
            $decoded = $this->parseJsonString($jsonString, $blockName);
            if ($decoded !== null) {
                return $decoded;
            }
        }

        // Cas 7: Recherche très flexible - tout JSON valide après le nom de bloc
        if (preg_match_all('/(\{[\s\S]*?\}|\[[\s\S]*?\])/', $content, $allMatches)) {
            $blockPosition = strpos(strtolower($content), strtolower($blockName));
            if ($blockPosition !== false) {
                foreach ($allMatches[1] as $match) {
                    $matchPosition = strpos($content, $match);
                    if ($matchPosition > $blockPosition) {
                        $decoded = $this->parseJsonString(trim($match), $blockName);
                        if ($decoded !== null) {
                            return $decoded;
                        }
                    }
                }
            }
        }

        // Si aucun bloc n'est trouvé, log pour debug
        Log::warning("Aucun bloc JSON trouvé pour {$blockName}", [
            'content_preview' => substr($content, 0, 1000).'...',
            'block_search' => $blockName,
        ]);

        return null;
    }

    private function parseJsonString(string $jsonString, string $blockName): ?array
    {
        try {
            // Nettoyer le JSON des caractères d'échappement courants
            $cleanJson = $this->cleanJsonString($jsonString);

            $decoded = json_decode($cleanJson, true, 512, JSON_THROW_ON_ERROR);

            // Vérifier que le résultat n'est pas vide
            if (empty($decoded)) {
                Log::warning("JSON décodé vide pour {$blockName}", ['json' => $cleanJson]);

                return null;
            }

            return $decoded;
        } catch (\JsonException $e) {
            Log::error("Failed to parse JSON for {$blockName}", [
                'json_string' => $jsonString,
                'clean_json' => $cleanJson ?? 'failed to clean',
                'error' => $e->getMessage(),
            ]);

            return null;
        }
    }

    private function cleanJsonString(string $json): string
    {
        // Supprimer les caractères de contrôle invisibles
        $json = preg_replace('/[\x00-\x1F\x7F]/', '', $json);

        // Nettoyer les échappements doubles
        $json = str_replace('\\\\', '\\', $json);

        // Nettoyer les guillemets échappés
        $json = str_replace('\\"', '"', $json);

        // Nettoyer les slashes échappés
        $json = str_replace('\\/', '/', $json);

        // Nettoyer les sauts de ligne échappés
        $json = str_replace('\\n', "\n", $json);
        $json = str_replace('\\r', "\r", $json);
        $json = str_replace('\\t', "\t", $json);

        // Supprimer les espaces en début et fin
        return trim($json);
    }

    private function generateFallback(array $params): array
    {
        $campaign = null;
        $campaignTitle = 'Page';
        $campaignDescription = 'Découvrez nos produits et services';

        try {
            $campaign = $this->campaignRepository->find($params['campaign_id']);
            if ($campaign) {
                $campaignTitle = $campaign->name ?? 'Page';
                $campaignDescription = $campaign->description ?? 'Découvrez nos produits et services';
            }
        } catch (\Exception $e) {
            Log::warning('Could not fetch campaign for fallback', ['error' => $e->getMessage()]);
        }

        $fallbackHtml = '<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>'.htmlspecialchars($campaignTitle).'</title>
    <style>
        * { 
            margin: 0; 
            padding: 0; 
            box-sizing: border-box; 
        }
        body { 
            font-family: -apple-system, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif; 
            line-height: 1.6; 
            color: #333;
        }
        .hero { 
            background: linear-gradient(135deg, ${hero.backgroundColor}, rgba(0,0,0,0.1));
            background-image: url("${hero.backgroundImage}");
            background-size: cover;
            background-position: center;
            color: white; 
            padding: 120px 20px; 
            text-align: center; 
            min-height: 70vh;
            display: flex;
            flex-direction: column;
            justify-content: center;
            position: relative;
        }
        .hero::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0,0,0,0.4);
            z-index: 1;
        }
        .hero-content {
            position: relative;
            z-index: 2;
            max-width: 800px;
            margin: 0 auto;
        }
        .hero h1 { 
            font-size: 3.5rem; 
            margin-bottom: 24px; 
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.3);
            line-height: 1.2;
        }
        .hero p { 
            font-size: 1.4rem; 
            margin-bottom: 40px; 
            opacity: 0.95;
            text-shadow: 1px 1px 2px rgba(0,0,0,0.3);
        }
        .btn { 
            display: inline-block; 
            background: #fff; 
            color: #333; 
            padding: 18px 36px; 
            text-decoration: none; 
            border-radius: 50px; 
            font-weight: 600;
            font-size: 1.1rem;
            box-shadow: 0 8px 32px rgba(0,0,0,0.2);
            transition: all 0.3s ease;
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }
        .btn:hover { 
            background: #f8f9fa; 
            transform: translateY(-2px);
            box-shadow: 0 12px 48px rgba(0,0,0,0.3);
        }
        .content-section {
            padding: 80px 20px;
            background: #f8f9fa;
            text-align: center;
        }
        .content-section h2 {
            font-size: 2.5rem;
            margin-bottom: 20px;
            color: #2c3e50;
        }
        .content-section p {
            font-size: 1.2rem;
            color: #666;
            max-width: 600px;
            margin: 0 auto 40px;
        }
        .features {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(300px, 1fr));
            gap: 40px;
            max-width: 1200px;
            margin: 60px auto 0;
            padding: 0 20px;
        }
        .feature {
            background: white;
            padding: 40px 30px;
            border-radius: 12px;
            box-shadow: 0 4px 24px rgba(0,0,0,0.1);
            transition: transform 0.3s ease;
        }
        .feature:hover {
            transform: translateY(-4px);
        }
        .feature h3 {
            font-size: 1.5rem;
            margin-bottom: 15px;
            color: #2c3e50;
        }
        .feature p {
            color: #666;
            margin: 0;
        }
        .footer { 
            background: #2c3e50; 
            color: white; 
            text-align: center; 
            padding: 60px 20px;
            margin-top: 0;
        }
        .footer p {
            font-size: 1rem;
            opacity: 0.8;
        }
        .footer-links {
            margin-top: 20px;
        }
        .footer-links a {
            color: white;
            text-decoration: none;
            margin: 0 15px;
            opacity: 0.8;
            transition: opacity 0.3s ease;
        }
        .footer-links a:hover {
            opacity: 1;
        }
        
        @media (max-width: 768px) {
            .hero h1 { font-size: 2.5rem; }
            .hero p { font-size: 1.2rem; }
            .hero { padding: 80px 20px; }
            .content-section h2 { font-size: 2rem; }
            .features { grid-template-columns: 1fr; gap: 30px; }
        }
    </style>
</head>
<body>
    <section class="hero">
        <div class="hero-content">
            <h1>${hero.title}</h1>
            <p>${hero.subtitle}</p>
            <a href="${hero.cta.link}" class="btn">${hero.cta.text}</a>
        </div>
    </section>
    
    <section class="content-section">
        <h2>${sections[0].title}</h2>
        <p>${sections[0].text}</p>
        
        <div class="features">
            <div class="feature">
                <h3>Qualité Premium</h3>
                <p>Des solutions de haute qualité adaptées à vos besoins spécifiques.</p>
            </div>
            <div class="feature">
                <h3>Support Expert</h3>
                <p>Une équipe d\'experts à votre disposition pour vous accompagner.</p>
            </div>
            <div class="feature">
                <h3>Innovation Continue</h3>
                <p>Des technologies de pointe pour rester à l\'avant-garde de votre secteur.</p>
            </div>
        </div>
    </section>
    
    <footer class="footer">
        <p>${footer.text}</p>
        <div class="footer-links">
            <a href="#contact">Contact</a>
            <a href="#mentions">Mentions légales</a>
            <a href="#confidentialite">Confidentialité</a>
        </div>
    </footer>
</body>
</html>';

        $fallbackData = [
            'hero' => [
                'title' => $campaignTitle,
                'subtitle' => $campaignDescription,
                'cta' => [
                    'text' => 'Découvrir maintenant',
                    'link' => $params['cta_url'] ?? 'https://example.com',
                ],
                'backgroundImage' => '',
                'backgroundColor' => $params['primary_color'] ?? '#667eea',
            ],
            'sections' => [
                [
                    'id' => 1,
                    'type' => 'text-section',
                    'title' => 'Pourquoi nous choisir ?',
                    'text' => 'Nous offrons des solutions innovantes et personnalisées pour répondre à tous vos besoins. Notre expertise et notre engagement vous garantissent des résultats exceptionnels.',
                    'backgroundColor' => '#f8f9fa',
                ],
            ],
            'footer' => [
                'text' => '© '.date('Y').' - Tous droits réservés',
                'links' => [
                    ['text' => 'Contact', 'link' => '#contact'],
                    ['text' => 'Mentions légales', 'link' => '#mentions'],
                    ['text' => 'Confidentialité', 'link' => '#confidentialite'],
                ],
            ],
        ];

        $dto = new LandingPageDto(
            id: null,
            content: [
                'template' => [
                    'html' => $fallbackHtml,
                    'data' => $fallbackData,
                ],
                'fallback' => true, // Mark as fallback
            ],
            campaign_id: $params['campaign_id']
        );

        try {
            $this->landingPageRepository->create($dto);
            Log::info('Fallback landing page created successfully', [
                'campaign_id' => $params['campaign_id'],
                'campaign_title' => $campaignTitle,
            ]);
        } catch (\Exception $e) {
            Log::error('Failed to save fallback landing page to database', [
                'error' => $e->getMessage(),
                'campaign_id' => $params['campaign_id'],
                'trace' => $e->getTraceAsString(),
            ]);
        }

        return $dto->toArray();
    }
}
