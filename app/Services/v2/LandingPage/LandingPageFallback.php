<?php

namespace App\Services\v2\LandingPage;

use App\Models\Campaign;

class LandingPageFallback
{
    public function generateFallback(Campaign $campaign): string
    {
        $heroTitle = $campaign->name ?? 'Campagne Marketing';
        $heroSubtitle = $campaign->description ?? 'Découvrez notre offre exceptionnelle';
        $businessName = $campaign->business_name ?? '';
        $company = $campaign->company ?? '';
        $industry = $campaign->industry ?? '';
        $location = $campaign->location ?? '';
        $targetAudience = $campaign->target_audience ?? '';
        $goals = $campaign->goals ?? 'Développer votre présence et atteindre vos objectifs';
        $budget = $campaign->budget ?? '';
        $keywords = is_array($campaign->keywords ?? null) ? implode(', ', $campaign->keywords) : ($campaign->keywords ?? '');
        $additionalNotes = $campaign->additional_notes ?? '';
        $preferredStyle = $campaign->preferred_style ?? '';
        $website = $campaign->website ?? '#';
        $email = $campaign->email ?? '';
        $phoneNumbers = is_array($campaign->phone_numbers ?? null) ? implode(', ', $campaign->phone_numbers) : ($campaign->phone_numbers ?? '');

        $backgroundImage = $this->getIndustryBackgroundImage($industry);
        
        $colorScheme = $this->getColorScheme($preferredStyle);

        return <<<HTML
        <!DOCTYPE html>
        <html lang="fr">
        <head>
            <meta charset="UTF-8">
            <meta name="viewport" content="width=device-width, initial-scale=1.0">
            <title>{$heroTitle}</title>
            <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
            <style>
                * { margin: 0; padding: 0; box-sizing: border-box; }
                
                body { 
                    font-family: 'Inter', -apple-system, BlinkMacSystemFont, 'Segoe UI', sans-serif; 
                    line-height: 1.6; 
                    color: #1a1a1a; 
                    background: #fafbfc;
                    overflow-x: hidden;
                }
                
                .hero { 
                    background: linear-gradient(135deg, {$colorScheme['primary']}, {$colorScheme['secondary']});
                    background-image: url('{$backgroundImage}');
                    background-size: cover;
                    background-position: center;
                    background-blend-mode: overlay;
                    color: white; 
                    padding: 120px 20px 80px; 
                    text-align: center; 
                    min-height: 100vh;
                    display: flex;
                    flex-direction: column;
                    justify-content: center;
                    position: relative;
                }
                
                .hero::before {
                    content: '';
                    position: absolute;
                    top: 0; left: 0; right: 0; bottom: 0;
                    background: rgba(0,0,0,0.4);
                    z-index: 1;
                }
                
                .hero-content {
                    position: relative;
                    z-index: 2;
                    max-width: 900px;
                    margin: 0 auto;
                }
                
                .hero h1 { 
                    font-size: clamp(2.5rem, 5vw, 4rem); 
                    font-weight: 700;
                    margin-bottom: 24px;
                    letter-spacing: -0.02em;
                    text-shadow: 0 4px 12px rgba(0,0,0,0.3);
                }
                
                .hero p { 
                    font-size: clamp(1.1rem, 2.5vw, 1.4rem); 
                    margin-bottom: 32px;
                    opacity: 0.95;
                    font-weight: 400;
                    max-width: 600px;
                    margin-left: auto;
                    margin-right: auto;
                }
                
                .hero-meta {
                    display: flex;
                    justify-content: center;
                    gap: 30px;
                    margin-bottom: 40px;
                    flex-wrap: wrap;
                }
                
                .hero-meta span {
                    background: rgba(255,255,255,0.2);
                    padding: 8px 20px;
                    border-radius: 25px;
                    font-size: 0.95rem;
                    backdrop-filter: blur(10px);
                    border: 1px solid rgba(255,255,255,0.3);
                }
                
                .cta-buttons {
                    display: flex;
                    gap: 20px;
                    justify-content: center;
                    flex-wrap: wrap;
                }
                
                .btn-primary { 
                    background: white;
                    color: {$colorScheme['primary']};
                    padding: 16px 32px;
                    text-decoration: none;
                    border-radius: 50px;
                    font-weight: 600;
                    font-size: 1.05rem;
                    box-shadow: 0 8px 32px rgba(0,0,0,0.2);
                    transition: all 0.3s ease;
                    display: inline-flex;
                    align-items: center;
                    gap: 8px;
                }
                
                .btn-secondary {
                    background: transparent;
                    color: white;
                    padding: 16px 32px;
                    text-decoration: none;
                    border-radius: 50px;
                    font-weight: 500;
                    font-size: 1.05rem;
                    border: 2px solid rgba(255,255,255,0.3);
                    transition: all 0.3s ease;
                    backdrop-filter: blur(10px);
                }
                
                .btn-primary:hover { 
                    transform: translateY(-2px);
                    box-shadow: 0 12px 48px rgba(0,0,0,0.3);
                    background: #f8f9fa;
                }
                
                .btn-secondary:hover {
                    background: rgba(255,255,255,0.1);
                    border-color: rgba(255,255,255,0.6);
                }
                
                .content-wrapper {
                    max-width: 1200px;
                    margin: -60px auto 0;
                    position: relative;
                    z-index: 3;
                    padding: 0 20px;
                }
                
                .info-card {
                    background: white;
                    border-radius: 24px;
                    padding: 60px 40px;
                    box-shadow: 0 20px 60px rgba(0,0,0,0.08);
                    margin-bottom: 80px;
                    text-align: center;
                }
                
                .info-card h2 {
                    font-size: clamp(1.8rem, 4vw, 2.5rem);
                    margin-bottom: 20px;
                    color: #1a1a1a;
                    font-weight: 600;
                }
                
                .info-card p {
                    font-size: 1.1rem;
                    color: #666;
                    max-width: 700px;
                    margin: 0 auto 40px;
                    line-height: 1.7;
                }
                
                .details-grid {
                    display: grid;
                    grid-template-columns: repeat(auto-fit, minmax(280px, 1fr));
                    gap: 30px;
                    margin-top: 50px;
                }
                
                .detail-card {
                    background: linear-gradient(135deg, #f8f9ff, #ffffff);
                    border-radius: 16px;
                    padding: 30px 24px;
                    text-align: left;
                    border: 1px solid rgba(0,0,0,0.06);
                    transition: transform 0.3s ease;
                }
                
                .detail-card:hover {
                    transform: translateY(-4px);
                    box-shadow: 0 12px 40px rgba(0,0,0,0.1);
                }
                
                .detail-card .label {
                    color: {$colorScheme['primary']};
                    font-weight: 600;
                    font-size: 0.9rem;
                    text-transform: uppercase;
                    letter-spacing: 0.5px;
                    margin-bottom: 8px;
                    display: block;
                }
                
                .detail-card .value {
                    color: #333;
                    font-size: 1.05rem;
                    font-weight: 500;
                    line-height: 1.5;
                }
                
                .contact-section {
                    background: linear-gradient(135deg, {$colorScheme['primary']}, {$colorScheme['secondary']});
                    color: white;
                    padding: 80px 40px;
                    border-radius: 24px;
                    text-align: center;
                    margin-bottom: 80px;
                }
                
                .contact-section h3 {
                    font-size: 2rem;
                    margin-bottom: 16px;
                    font-weight: 600;
                }
                
                .contact-section p {
                    font-size: 1.1rem;
                    margin-bottom: 30px;
                    opacity: 0.9;
                }
                
                .contact-info {
                    display: flex;
                    justify-content: center;
                    gap: 40px;
                    flex-wrap: wrap;
                }
                
                .contact-item {
                    background: rgba(255,255,255,0.15);
                    padding: 20px 30px;
                    border-radius: 16px;
                    backdrop-filter: blur(10px);
                    border: 1px solid rgba(255,255,255,0.2);
                }
                
                .contact-item .label {
                    font-size: 0.9rem;
                    opacity: 0.8;
                    margin-bottom: 5px;
                }
                
                .contact-item .value {
                    font-weight: 600;
                    font-size: 1.05rem;
                }
                
                .footer {
                    background: #1a1a1a;
                    color: #ccc;
                    text-align: center;
                    padding: 50px 20px 30px;
                    margin-top: 0;
                }
                
                .footer p {
                    margin-bottom: 20px;
                    font-size: 0.95rem;
                }
                
                .footer-links {
                    display: flex;
                    justify-content: center;
                    gap: 30px;
                    flex-wrap: wrap;
                }
                
                .footer-links a {
                    color: #ccc;
                    text-decoration: none;
                    font-size: 0.9rem;
                    transition: color 0.3s ease;
                }
                
                .footer-links a:hover {
                    color: white;
                }
                
                @media (max-width: 768px) {
                    .hero { padding: 80px 20px 60px; min-height: 80vh; }
                    .info-card { padding: 40px 24px; margin-bottom: 60px; }
                    .details-grid { grid-template-columns: 1fr; gap: 20px; }
                    .contact-section { padding: 60px 24px; margin-bottom: 60px; }
                    .contact-info { flex-direction: column; gap: 20px; }
                    .hero-meta { gap: 15px; }
                    .cta-buttons { flex-direction: column; align-items: center; }
                }
                
                @media (max-width: 480px) {
                    .content-wrapper { padding: 0 16px; }
                    .detail-card { padding: 24px 20px; }
                    .contact-item { padding: 16px 20px; }
                }
            </style>
        </head>
        <body>
            <section class="hero">
                <div class="hero-content">
                    <h1>{$heroTitle}</h1>
                    <p>{$heroSubtitle}</p>
                    
                    <div class="hero-meta">
                        {$this->renderHeroMeta($businessName, $company, $industry, $location)}
                    </div>
                    
                    <div class="cta-buttons">
                        <a href="{$website}" class="btn-primary">
                            Découvrir
                            <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                <path d="M7 17L17 7M17 7H7M17 7V17"/>
                            </svg>
                        </a>
                        <a href="#contact" class="btn-secondary">En savoir plus</a>
                    </div>
                </div>
            </section>
            
            <div class="content-wrapper">
                <div class="info-card">
                    <h2>Notre Mission</h2>
                    <p>{$goals}</p>
                    
                    <div class="details-grid">
                        {$this->renderDetailCards($targetAudience, $budget, $keywords, $additionalNotes, $preferredStyle)}
                    </div>
                </div>
                
                <div class="contact-section" id="contact">
                    <h3>Contactez-nous</h3>
                    <p>Prêt à commencer votre projet ? Nous sommes là pour vous accompagner.</p>
                    
                    <div class="contact-info">
                        {$this->renderContactInfo($email, $phoneNumbers, $website)}
                    </div>
                </div>
            </div>
            
            <footer class="footer">
                <p>© 2025 {$businessName} - Tous droits réservés</p>
                <div class="footer-links">
                    <a href="#mentions">Mentions légales</a>
                    <a href="#confidentialite">Confidentialité</a>
                    <a href="#conditions">Conditions d'utilisation</a>
                </div>
            </footer>
        </body>
        </html>
        HTML;
    }

    private function getIndustryBackgroundImage(string $industry): string
    {
        $backgrounds = [
            'technologie' => 'https://images.unsplash.com/photo-1451187580459-43490279c0fa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
            'finance' => 'https://images.unsplash.com/photo-1611974789855-9c2a0a7236a3?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
            'santé' => 'https://images.unsplash.com/photo-1576091160399-112ba8d25d1f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
            'éducation' => 'https://images.unsplash.com/photo-1523050854058-8df90110c9f1?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
            'immobilier' => 'https://images.unsplash.com/photo-1560518883-ce09059eeffa?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
            'marketing' => 'https://images.unsplash.com/photo-1460925895917-afdab827c52f?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
            'restaurant' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
            'mode' => 'https://images.unsplash.com/photo-1441986300917-64674bd600d8?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80',
        ];

        $industryLower = strtolower($industry);
        foreach ($backgrounds as $key => $url) {
            if (strpos($industryLower, $key) !== false) {
                return $url;
            }
        }

        return 'https://images.unsplash.com/photo-1497366216548-37526070297c?ixlib=rb-4.0.3&auto=format&fit=crop&w=1920&q=80';
    }

    private function getColorScheme(string $preferredStyle): array
    {
        $schemes = [
            'moderne' => ['primary' => '#667eea', 'secondary' => '#764ba2'],
            'élégant' => ['primary' => '#2c3e50', 'secondary' => '#3498db'],
            'professionnel' => ['primary' => '#34495e', 'secondary' => '#2980b9'],
            'créatif' => ['primary' => '#e74c3c', 'secondary' => '#f39c12'],
            'minimaliste' => ['primary' => '#1a1a1a', 'secondary' => '#4a4a4a'],
            'coloré' => ['primary' => '#9b59b6', 'secondary' => '#e91e63'],
        ];

        $styleLower = strtolower($preferredStyle);
        foreach ($schemes as $key => $colors) {
            if (strpos($styleLower, $key) !== false) {
                return $colors;
            }
        }

        return ['primary' => '#667eea', 'secondary' => '#764ba2'];
    }

    private function renderHeroMeta(string $businessName, string $company, string $industry, string $location): string
    {
        $meta = [];
        
        if ($businessName) $meta[] = "<span>{$businessName}</span>";
        if ($company && $company !== $businessName) $meta[] = "<span>{$company}</span>";
        if ($industry) $meta[] = "<span>{$industry}</span>";
        if ($location) $meta[] = "<span>{$location}</span>";
        
        return implode('', $meta);
    }

    private function renderDetailCards(string $targetAudience, string $budget, string $keywords, string $additionalNotes, string $preferredStyle): string
    {
        $cards = [];
        
        if ($targetAudience) {
            $cards[] = '<div class="detail-card"><span class="label">Public Cible</span><div class="value">' . htmlspecialchars($targetAudience) . '</div></div>';
        }
        
        if ($budget) {
            $cards[] = '<div class="detail-card"><span class="label">Budget</span><div class="value">' . htmlspecialchars($budget) . '</div></div>';
        }
        
        if ($keywords) {
            $cards[] = '<div class="detail-card"><span class="label">Mots-clés</span><div class="value">' . htmlspecialchars($keywords) . '</div></div>';
        }
        
        if ($preferredStyle) {
            $cards[] = '<div class="detail-card"><span class="label">Style Préféré</span><div class="value">' . htmlspecialchars($preferredStyle) . '</div></div>';
        }
        
        if ($additionalNotes) {
            $cards[] = '<div class="detail-card"><span class="label">Notes Supplémentaires</span><div class="value">' . htmlspecialchars($additionalNotes) . '</div></div>';
        }
        
        return implode('', $cards);
    }

    private function renderContactInfo(string $email, string $phoneNumbers, string $website): string
    {
        $contacts = [];
        
        if ($email) {
            $contacts[] = '<div class="contact-item"><div class="label">Email</div><div class="value">' . htmlspecialchars($email) . '</div></div>';
        }
        
        if ($phoneNumbers) {
            $contacts[] = '<div class="contact-item"><div class="label">Téléphone</div><div class="value">' . htmlspecialchars($phoneNumbers) . '</div></div>';
        }
        
        if ($website && $website !== '#') {
            $contacts[] = '<div class="contact-item"><div class="label">Site Web</div><div class="value"><a href="' . htmlspecialchars($website) . '" style="color: white; text-decoration: none;">' . htmlspecialchars($website) . '</a></div></div>';
        }
        
        return implode('', $contacts);
    }
}
