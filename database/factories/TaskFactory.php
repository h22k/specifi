<?php

namespace Database\Factories;

use App\Models\TaskCategory;
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
            'category_id' => TaskCategory::factory()->create()->id,
            'assigned_to' => User::factory()->create()->id,
            'created_by'  => User::factory()->create()->id,
            'title'       => $this->faker->text(15),
            'description' => $this->faker->text,
            'progress'    => $this->faker->randomElement(['to_do', 'in_progress', 'need_review', 'done'])
        ];
    }
}
