<?php

namespace Tests\Feature\Images;

use App\Models\Campaign;
use App\Models\Image;
use App\Models\User;
use Laravel\Sanctum\Sanctum;
use PHPUnit\Framework\Attributes\Test;

class ImageCrudOperationsTest extends BaseImageTest
{
    #[Test]
    public function can_create_image_with_valid_data()
    {
        $user = User::factory()->create();

        Sanctum::actingAs($user);

        $campaign = Campaign::factory()->create([
            'user_id' => $user->id,
        ]);

        $data = [
            'path' => 'images/photo.jpg',
            'campaign_id' => $campaign->id,
        ];

        $response = $this->postJson('/api/images', $data);

        $response->assertCreated();
        $this->assertDatabaseHas('images', $data);
    }

    #[Test]
    public function can_retrieve_single_image()
    {
        $image = Image::factory()->create(['campaign_id' => $this->campaign->id]);
        Sanctum::actingAs($this->user);

        $response = $this->getJson("/api/images/{$image->id}");
        $response->assertOk()
            ->assertJsonPath('data.id', $image->id);
    }

    #[Test]
    public function can_update_existing_image()
    {
        $image = Image::factory()->create(['campaign_id' => $this->campaign->id]);
        Sanctum::actingAs($this->user);

        $updateData = ['path' => 'updated/path.jpg', 'is_published' => false];
        $response = $this->putJson("/api/images/{$image->id}", $updateData);

        $response->assertOk();
        $this->assertDatabaseHas('images', array_merge(['id' => $image->id], $updateData));
    }

    #[Test]
    public function can_delete_image()
    {
        $image = Image::factory()->create(['campaign_id' => $this->campaign->id]);
        Sanctum::actingAs($this->user);

        $response = $this->deleteJson("/api/images/{$image->id}");
        $response->assertOk();
        $this->assertDatabaseMissing('images', ['id' => $image->id]);
    }
}
