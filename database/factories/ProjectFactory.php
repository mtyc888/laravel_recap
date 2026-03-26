<?php

namespace Database\Factories;

use App\Models\Project;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
/**
 * @extends Factory<Project>
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
        return [
            'client_id' => Client::factory(),
            'name' => fake()->catchPhrase(),
            'description' => fake()->paragraph(),
            'status' => fake()->randomElement(['active','completed','on_hold']),
            'hourly_rate' => fake()->randomElement([75, 100, 125, 150, 200])
        ];
    }
}
