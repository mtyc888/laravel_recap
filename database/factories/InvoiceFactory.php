<?php

namespace Database\Factories;

use App\Models\Invoice;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Client;
/**
 * @extends Factory<Invoice>
 */
class InvoiceFactory extends Factory
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
            'status' => fake()->randomElement(['draft', 'send', 'paid', 'overdue']),
            'issue_date' => fake()->dateTimeBetween('-6 months', 'now'),
            'due_date' => (clone fake()->dateTimeBetween('-6 months', 'now'))->modify("+30 days"),
            'sub_total' => 0,
            'tax_rate' => 6.0,
            'tax_amount' => 0,
            'total' => 0,
            'invoice_number' => 'INV-' . fake()->unique()->numerify('####')
        ];
    }
}
