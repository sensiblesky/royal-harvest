<?php

return [
    'salon_url' => env('SALON_URL', 'https://pixiesbridalsaloon.royalharvest.co.tz'),
    'phone' => env('COMPANY_PHONE', '+255 759 389 897'),
    'email' => env('COMPANY_EMAIL', 'info@royalharvest.co.tz'),
    'address' => env('COMPANY_ADDRESS', 'Arusha, Tanzania'),
    'whatsapp' => env('COMPANY_WHATSAPP'), // international digits only, e.g. 255759389897
    'analytics_ga_id' => env('ANALYTICS_GA_ID'),
    'socials' => [
        'instagram' => env('COMPANY_INSTAGRAM'),
        'facebook' => env('COMPANY_FACEBOOK'),
        'linkedin' => env('COMPANY_LINKEDIN'),
        'whatsapp' => env('COMPANY_WHATSAPP') ? 'https://wa.me/'.env('COMPANY_WHATSAPP') : null,
    ],
];
