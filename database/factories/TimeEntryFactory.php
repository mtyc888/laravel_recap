<?php

namespace Database\Factories;

use App\Models\TimeEntry;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Project;
/**
 * @extends Factory<TimeEntry>
 */
class TimeEntryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $started = fake()->dateTimeBetween('-3 months', 'now');
        $duration = fake()->numberBetween(15,480);
        return [
            'project_id' => Project::factory(),
            'description' => fake()->paragraph(),
            'started_at' => $started,
            'ended_at' => (clone $started)->modify("+{$duration} minutes"),
            'duration_minutes' => $duration,
            'billable' => fake()->boolean(80)
        ];
    }
}
