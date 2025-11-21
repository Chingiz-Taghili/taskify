<?php

namespace Database\Factories;

use App\Enums\TaskStatus;
use App\Models\Category;
use App\Models\Client;
use App\Models\Project;
use App\Models\TaskUser;
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
        return [
            'client_id' => Client::inRandomOrder()->value('id'),
            'project_id' => Project::inRandomOrder()->value('id'),
            'category_id' => Category::inRandomOrder()->value('id'),
            'title' => $this->faker->sentence(),
            'description' => $this->faker->paragraph(),
            'status' => TaskStatus::TODO->value,
            'due_date' => $this->faker->date(),
        ];
    }

    public function configure(): static
    {
        return $this->afterCreating(function ($task) {
            $userId = User::inRandomOrder()->value('id');
            TaskUser::create(['task_id' => $task->id,
                'user_id' => $userId, 'assigned_by' => 1, 'assigned_at' => now(),]);
        });
    }
}
