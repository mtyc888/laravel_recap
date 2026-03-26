<?php

namespace Database\Factories;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
/**
 * @extends Factory<Client>
 */
class ClientFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'uuid' => fake()->uuid(),
            'name' => fake()->name(),
            'email' => fake()->email(),
            'company' => fake()->company(),
            'phone' => fake()->phoneNumber(),
            'address' => fake()->address(),
        ];
    }
}
