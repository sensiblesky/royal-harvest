<?php

namespace App\Http\Controllers;

use App\Models\Service;

class PageController extends Controller
{
    public function home()
    {
        $services = Service::where('isActive', true)->orderBy('sort')->take(6)->get();

        return view('pages.home', compact('services'));
    }

    public function services()
    {
        $services = Service::where('isActive', true)->orderBy('sort')->get();

        return view('pages.services', compact('services'));
    }

    public function about()
    {
        return view('pages.about');
    }

    public function gallery()
    {
        $images = [
            ['src' => 'images/afr-woman.jpg', 'title' => 'Bridal Elegance', 'category' => 'Bridal Makeup'],
            ['src' => 'images/makeup-flatlay.jpg', 'title' => 'Flawless Finish', 'category' => 'Makeup Artistry'],
            ['src' => 'images/afr-curly.jpg', 'title' => 'Natural Beauty', 'category' => 'Hair Styling'],
            ['src' => 'images/hair-tools.jpg', 'title' => 'Precision Styling', 'category' => 'Hair Styling'],
            ['src' => 'images/bg_8.jpg', 'title' => 'Perfect Manicure', 'category' => 'Nails & Manicure'],
            ['src' => 'images/skincare-products.jpg', 'title' => 'Radiant Skincare', 'category' => 'Spa & Skincare'],
            ['src' => 'images/salon-interior.jpg', 'title' => 'Our Studio', 'category' => 'The Salon'],
        ];

        return view('pages.gallery', compact('images'));
    }
}
