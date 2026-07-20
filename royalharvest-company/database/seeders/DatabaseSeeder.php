<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Programme;
use App\Models\User;
use App\Models\Venture;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['email' => 'admin@royalharvest.co.tz'],
            [
                'name' => 'Royal Harvest Admin',
                'password' => Hash::make('password'),
                'email_verified_at' => now(),
            ]
        );

        $programmes = [
            ['name' => 'Starter Dreadlocks', 'cost' => 'TSh 250,000', 'duration' => '3 Months', 'image' => 'images/bg_5.jpg', 'summary' => 'Learn the fundamentals of starting, sectioning and maintaining beautiful dreadlocks from scratch.'],
            ['name' => 'Advanced Dreadlocks', 'cost' => 'TSh 400,000', 'duration' => '3 Months', 'image' => 'images/afr-curly.jpg', 'summary' => 'Master advanced locking techniques, repairs, styling and client care for a professional career.'],
            ['name' => 'Professional Makeup Artistry', 'cost' => 'TSh 350,000', 'duration' => '2 Months', 'image' => 'images/makeup-flatlay.jpg', 'summary' => 'From bridal to editorial — build a complete makeup skill set with hands-on practice.'],
            ['name' => 'Hairdressing & Styling', 'cost' => 'TSh 450,000', 'duration' => '4 Months', 'image' => 'images/hair-tools.jpg', 'summary' => 'Cutting, colouring, treatments and elegant styling for salon-ready professionals.'],
            ['name' => 'Nail Technology', 'cost' => 'TSh 200,000', 'duration' => '6 Weeks', 'image' => 'images/salon-interior.jpg', 'summary' => 'Manicure, pedicure, gel and nail art techniques with business fundamentals.'],
            ['name' => 'Bridal Beauty Specialist', 'cost' => 'TSh 500,000', 'duration' => '3 Months', 'image' => 'images/afr-woman.jpg', 'summary' => 'Specialise in complete bridal transformations — makeup, hair and styling.'],
        ];
        foreach ($programmes as $p) {
            Programme::updateOrCreate(['name' => $p['name']], $p);
        }

        $blogs = [
            ['title' => 'Urembo Wa Levo Nyingine', 'image' => 'images/afr-woman.jpg', 'content' => 'Kuanzia nywele, makeup, nails hadi bridal services, kila huduma hufanywa kwa umakini mkubwa na wataalamu waliobobea. Karibu Royal Harvest kujifunza ujuzi wa urembo wa kiwango cha juu.'],
            ['title' => 'Why a Beauty Career is Future-Proof', 'image' => 'images/makeup-flatlay.jpg', 'content' => 'The beauty industry continues to grow across Africa. A professional qualification from Royal Harvest opens doors to salon work, freelancing and entrepreneurship.'],
            ['title' => 'From Student to Salon Owner', 'image' => 'images/skincare-products.jpg', 'content' => 'Many of our graduates now run their own thriving salons. Discover how our practical, mentor-led training sets you up for real-world success.'],
        ];
        foreach ($blogs as $b) {
            Blog::updateOrCreate(['title' => $b['title']], $b);
        }

        $ventures = [
            [
                'name' => 'Pixies Bridal Saloon',
                'tagline' => 'Premium bridal beauty & styling',
                'description' => 'Our flagship beauty destination in Arusha — bridal makeup, hairstyling, nails and spa for every special occasion.',
                'category' => 'Beauty',
                'image' => 'images/afr-woman.jpg',
                'icon' => 'crown',
                'url' => config('site.salon_url'),
                'status' => 'live',
                'sort' => 1,
            ],
            [
                'name' => 'Royal Harvest Beauty Academy',
                'tagline' => 'Professional beauty training',
                'description' => 'Hands-on, mentor-led courses in dreadlocks, makeup, hairdressing and nail technology — building skilled artists and entrepreneurs.',
                'category' => 'Education',
                'image' => 'images/afr-curly.jpg',
                'icon' => 'sparkles',
                'url' => '/programmes',
                'status' => 'live',
                'sort' => 2,
            ],
            [
                'name' => 'Royal Harvest Products',
                'tagline' => 'Beauty products — coming soon',
                'description' => 'A curated line of quality hair and beauty products, made for African beauty. Launching soon.',
                'category' => 'Retail',
                'image' => 'images/makeup-flatlay.jpg',
                'icon' => 'leaf',
                'status' => 'coming_soon',
                'sort' => 3,
            ],
            [
                'name' => 'Royal Harvest Spa',
                'tagline' => 'Wellness & spa — coming soon',
                'description' => 'A relaxing wellness and spa experience for the whole family. Opening soon in Arusha.',
                'category' => 'Wellness',
                'image' => 'images/skincare-products.jpg',
                'icon' => 'heart',
                'status' => 'coming_soon',
                'sort' => 4,
            ],
        ];
        foreach ($ventures as $v) {
            Venture::updateOrCreate(['name' => $v['name']], $v);
        }
    }
}
