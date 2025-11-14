<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $client = Client::inRandomOrder()->first();

        return [
            'name' => $this->faker->words(2, true),
            'client_id' => $client->id,
            'description' => $this->faker->sentence(),
            'cover_photo' => $this->faker->imageUrl(),
        ];
    }
}
