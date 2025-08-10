<?php

namespace Tests\Feature\Prompts;

use App\Models\Prompt;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class PromptCrudOperationsTest extends BasePromptTest
{
    #[Test]
    public function can_create_prompt_with_valid_data()
    {
        Sanctum::actingAs($this->user);

        $response = $this->postJson('/api/prompts', $this->validPromptData());

        $response->assertCreated();
        $this->assertDatabaseHas('prompts', $this->validPromptData());
    }

    #[Test]
    public function can_retrieve_single_prompt()
    {
        $prompt = Prompt::factory()->create([
            'campaign_id' => $this->campaign->id,
            'content' => 'Specific prompt content'
        ]);

        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/prompts/{$prompt->id}");

        $response->assertOk()
            ->assertJsonPath('data.id', $prompt->id)
            ->assertJsonPath('data.content', 'Specific prompt content');
    }

    #[Test]
    public function can_update_existing_prompt()
    {
        $prompt = Prompt::factory()->create($this->validPromptData());
        Sanctum::actingAs($this->user);

        $updateData = ['content' => 'Updated prompt content'];

        $response = $this->putJson("/api/prompts/{$prompt->id}", $updateData);

        $response->assertOk();
        $this->assertDatabaseHas('prompts', array_merge(
            ['id' => $prompt->id],
            $updateData
        ));
    }

    #[Test]
    public function can_delete_prompt()
    {
        $prompt = Prompt::factory()->create($this->validPromptData());
        Sanctum::actingAs($this->user);

        $response = $this->deleteJson("/api/prompts/{$prompt->id}");

        $response->assertOk();
        $this->assertDatabaseMissing('prompts', ['id' => $prompt->id]);
    }

    #[Test]
    public function can_list_prompts()
    {
        Prompt::factory(3)->create($this->validPromptData());
        Sanctum::actingAs($this->user);

        $response = $this->getJson('/api/prompts');

        $response->assertOk()
            ->assertJsonCount(3, 'data');
    }
}
