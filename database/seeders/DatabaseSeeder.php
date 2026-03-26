<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;
use App\Models\Project;
use App\Models\TimeEntry;
use App\Models\Invoice;
use App\Models\LineItem;
class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        $user = User::factory()->create([
            'name' => 'Marvin',
            'email' => 'ymarvintan@gmail.com',
        ]);

        $clients = Client::factory(5)->create(['user_id' => $user->id]);

        foreach($clients as $client){
            // for each client, we need to create:
            // random amount of projects (1-3) -> for each project create random time entries
            // random amount of invoices (1-4) -> for each invoice create random line items

            $projects = Project::factory(rand(1,3))->create(['client_id' => $client->id]);
            foreach($projects as $project){
                TimeEntry::factory(rand(5,15))->create(['project_id' => $project->id]);
            }

            $invoices = Invoice::factory(rand(1,4))->create(['client_id' => $client->id, 'user_id' => $user->id]);
            foreach($invoices as $invoice){
                LineItem::factory(rand(1,5))->create(['invoice_id' => $invoice->id]);
                //recalculateTotal() from invoice model will be called automatically as each LineItem is created
            }
        }
    }
}
