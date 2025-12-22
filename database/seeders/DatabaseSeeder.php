<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::truncate();

        \App\Models\User::create([
            'name' => 'conic',
            'email' => 'cbunih@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('conicmaster'),
        ]);


        \App\Models\User::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'email_verified_at' => now(),
            'password' => bcrypt('royalHarvest25'),
        ]);
    }
}
