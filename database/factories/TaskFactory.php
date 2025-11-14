<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Task>
 */
class TaskFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $user = User::inRandomOrder()->first();
        $client = Client::inRandomOrder()->first();
        $project = Project::inRandomOrder()->first();
        $category = Category::inRandomOrder()->first();

        return [
            'user_id' => $user->id,
            'client_id' => $client ? $client->id : null,
            'project_id' => $project ? $project->id : null,
            'category_id' => $category ? $category->id : null,
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'due_date' => $this->faker->date(),
        ];
    }
}
