<?php

return [
    'company_url' => env('COMPANY_URL', 'https://royalharvest.co.tz'),
    'phone' => env('SALON_PHONE', '+255 759 389 897'),
    'email' => env('SALON_EMAIL', 'info@pixiesbridal.co.tz'),
    'address' => env('SALON_ADDRESS', 'Arusha, Tanzania'),
    'whatsapp' => env('SALON_WHATSAPP'), // international digits only, e.g. 255759389897
    'analytics_ga_id' => env('ANALYTICS_GA_ID'),
    'socials' => [
        'instagram' => env('SALON_INSTAGRAM'),
        'facebook' => env('SALON_FACEBOOK'),
        'tiktok' => env('SALON_TIKTOK'),
        'whatsapp' => env('SALON_WHATSAPP') ? 'https://wa.me/'.env('SALON_WHATSAPP') : null,
    ],
];
