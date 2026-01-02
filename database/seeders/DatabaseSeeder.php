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

        // User::truncate();
        // \App\Models\User::create([
        //     'name' => 'conic',
        //     'email' => 'cbunih@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('conicmaster'),
        // ]);


        // \App\Models\User::create([
        //     'name' => 'admin',
        //     'email' => 'admin@gmail.com',
        //     'email_verified_at' => now(),
        //     'password' => bcrypt('royalHarvest25'),
        // ]);


        \App\Models\Programme::create(['name' => 'Starter Dreadlocks','cost' => '$500','duration' =>"3 Month",]);
        \App\Models\Programme::create(['name' => 'Advanced Dreadlocks','cost' => '$500','duration' =>"3 Month",]);
        \App\Models\Programme::create(['name' => 'Underlock Styling','cost' => '$500','duration' =>"3 Month",]);
        \App\Models\Programme::create(['name' => 'Beginner Dreadlocks','cost' => '$500','duration' =>"3 Month",]);
        \App\Models\Programme::create(['name' => 'Weaving Setup','cost' => '$500','duration' =>"3 Month",]);
        \App\Models\Programme::create(['name' => 'Hair Retouching','cost' => '$500','duration' =>"3 Month",]);
        \App\Models\Programme::create(['name' => 'Natural Hairstyles','cost' => '$500','duration' =>"3 Month",]);
        \App\Models\Programme::create(['name' => 'Knotless Braids','cost' => '$500','duration' =>"3 Month",]);
        \App\Models\Programme::create(['name' => 'Crochet Braids','cost' => '$500','duration' =>"3 Month",]);
        \App\Models\Programme::create(['name' => 'Eyelash Extensions','cost' => '$500','duration' =>"3 Month",]);
        \App\Models\Programme::create(['name' => 'Bridal Styling','cost' => '$500','duration' =>"3 Month",]);
        \App\Models\Programme::create(['name' => 'Nail Care & Design','cost' => '$500','duration' =>"3 Month",]);
        \App\Models\Programme::create(['name' => 'Barber Services','cost' => '$500','duration' =>"3 Month",]);


    }
}
