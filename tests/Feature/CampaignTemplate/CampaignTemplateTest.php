<?php

namespace Tests\Feature\CampaignTemplate;

use App\Services\Interfaces\CampaignTemplateServiceInterface;
use Tests\TestCase;

class CampaignTemplateTest extends TestCase
{
    public function test_can_get_all_templates_with_stats()
    {
        $service = $this->app->make(CampaignTemplateServiceInterface::class);

        $templates = $service->getAllTemplatesWithStats();

        $this->assertIsIterable($templates);
        // Récupération du premier élément selon le type
        if ($templates instanceof \Illuminate\Support\Collection) {
            $first = $templates->first();
        } elseif (is_array($templates)) {
            $first = reset($templates); // premier élément du tableau
        } else {
            $this->fail('The templates must be either a Collection or an array.');
        }

        // Vérification flexible : objet ou tableau
        if (is_array($first)) {
            $this->assertArrayHasKey('name', $first);
            $this->assertArrayHasKey('average_rating', $first);
            $this->assertArrayHasKey('total_uses', $first);
        } elseif (is_object($first)) {
            $this->assertTrue(property_exists($first, 'name'), 'name property is missing');
            $this->assertTrue(property_exists($first, 'average_rating'), 'average_rating property is missing');
            $this->assertTrue(property_exists($first, 'total_uses'), 'total_uses property is missing');
        }
    }
}
