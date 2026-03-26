<?php

namespace Database\Factories;

use App\Models\LineItem;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Invoice;
/**
 * @extends Factory<LineItem>
 */
class LineItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $quantity = fake()->randomFloat(1, 1, 40);
        $unitPrice = fake()->randomElement([75, 100, 125, 150, 175]);
        return [
            'invoice_id' => Invoice::factory(),
            'description' => fake()->paragraph(),
            'quantity' => $quantity,
            'unit_price' => $unitPrice,
            'amount' => $quantity * $unitPrice,
        ];
    }
}
