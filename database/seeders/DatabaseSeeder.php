<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\OpenResto;
use App\Models\Table;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(5)->create();
        // \App\Models\Categories::factory(5)->create();
        // \App\Models\Products::factory(5)->create();
        // OpenResto::create([
        //     'is_open' => 1,
        // ]);

        for ($i = 1; $i < 25; $i++) {
            Table::create([
                'name' => "Meja $i",
                'status' => "Available",
            ]);
        }
        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
        // $this->call([
        //     UserSeeder::class,
        // ]);
    }
}
