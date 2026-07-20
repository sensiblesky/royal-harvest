<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@pixiesbridal.co.tz'],
            [
                'name' => 'Pixies Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $services = [
            [
                'name' => 'Bridal Makeup & Styling',
                'tagline' => 'Your dream bridal look, perfected',
                'description' => 'Customized bridal hairstyle and a trial makeup session so you look flawless from the ceremony to the last dance.',
                'price' => 'From TSh 350,000',
                'price_amount' => 350000,
                'duration' => '2–3 hrs',
                'image' => 'images/afr-woman.jpg',
                'icon' => 'crown',
                'sort' => 1,
            ],
            [
                'name' => 'Hair Styling & Treatments',
                'tagline' => 'Healthy, radiant, effortless hair',
                'description' => 'Cuts, blow-dry, deep conditioning and elegant updos crafted by our expert stylists for every occasion.',
                'price' => 'From TSh 40,000',
                'price_amount' => 40000,
                'duration' => '45–90 min',
                'image' => 'images/hair-tools.jpg',
                'icon' => 'scissors',
                'sort' => 2,
            ],
            [
                'name' => 'Makeup Artistry',
                'tagline' => 'For weddings, events & photoshoots',
                'description' => 'Soft glam to bold editorial looks using premium, long-wear products tailored to your skin and style.',
                'price' => 'From TSh 80,000',
                'price_amount' => 80000,
                'duration' => '1 hr',
                'image' => 'images/makeup-flatlay.jpg',
                'icon' => 'sparkles',
                'sort' => 3,
            ],
            [
                'name' => 'Nails & Manicure',
                'tagline' => 'Polished from head to toe',
                'description' => 'Manicure, pedicure, gel and elegant nail art finished with care in a relaxing setting.',
                'price' => 'From TSh 30,000',
                'price_amount' => 30000,
                'duration' => '45 min',
                'image' => 'images/salon-interior.jpg',
                'icon' => 'heart',
                'sort' => 4,
            ],
            [
                'name' => 'Spa & Skincare',
                'tagline' => 'Glow that lasts',
                'description' => 'Facials and skincare rituals designed to refresh, hydrate and reveal your natural radiance.',
                'price' => 'From TSh 60,000',
                'price_amount' => 60000,
                'duration' => '1 hr',
                'image' => 'images/skincare-products.jpg',
                'icon' => 'leaf',
                'sort' => 5,
            ],
            [
                'name' => 'Bridal Party Packages',
                'tagline' => 'Beauty for the whole party',
                'description' => 'Group packages for brides, bridesmaids and mothers — coordinated looks for your special day.',
                'price' => 'Custom quote',
                'price_amount' => null,
                'duration' => 'Half day',
                'image' => 'images/afr-curly.jpg',
                'icon' => 'users',
                'sort' => 6,
            ],
        ];

        foreach ($services as $s) {
            Service::updateOrCreate(['name' => $s['name']], $s);
        }
    }
}
