<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TarifUser;
use App\Models\Tarif;
use App\Models\User;
/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TarifUser>
 */
class TarifUserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    protected $model = TarifUser::class;

    public function definition(): array
    {
        $tarif = Tarif::inRandomOrder()->first() ?? Tarif::factory()->create();
        $user = User::inRandomOrder()->first() ?? User::factory()->create();

        $createdAt = now();
        if (strtolower($tarif->name) === 'pro') {
            $expiredAt = $createdAt->copy()->addDays(30);
        } else {
            $expiredAt = $createdAt->copy()->addDays(1);
        }

        return [
            'tarif_id' => $tarif->id,
            'user_id' => $user->id,
            'created_at' => $createdAt,
            'expired_at' => $expiredAt,
        ];
    }
}
