<?php

namespace Tests\Feature\Socials;

use App\Models\Social;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class SocialCrudOperationsTest extends BaseSocialTest
{
    #[Test]
    public function admin_can_create_social()
    {
        Sanctum::actingAs($this->admin);
        $response = $this->postJson('/api/socials', $this->validSocialData());

        $response->assertCreated();
        $this->assertDatabaseHas('socials', $this->validSocialData());
    }

    #[Test]
    public function can_retrieve_single_social()
    {
        $social = Social::factory()->create(['name' => 'Twitter']);
        Sanctum::actingAs($this->admin);

        $response = $this->getJson("/api/socials/{$social->id}");

        $response->assertOk()
            ->assertJsonPath('data.name', 'Twitter');
    }

    #[Test]
    public function admin_can_update_social()
    {
        $social = Social::factory()->create();
        Sanctum::actingAs($this->admin);

        $updateData = ['name' => 'Nouveau Nom'];

        $response = $this->putJson("/api/socials/{$social->id}", $updateData);

        $response->assertOk();
        $this->assertDatabaseHas('socials', array_merge(
            ['id' => $social->id],
            $updateData
        ));
    }

    #[Test]
    public function admin_can_delete_social()
    {
        $social = Social::factory()->create();
        Sanctum::actingAs($this->admin);

        $response = $this->deleteJson("/api/socials/{$social->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('socials', ['id' => $social->id]);
    }

    #[Test]
    public function can_list_socials()
    {
        Social::factory(3)->create();
        Sanctum::actingAs($this->admin);

        $response = $this->getJson('/api/socials');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
