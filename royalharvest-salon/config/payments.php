<?php

return [
    /*
    | Snippe (https://docs.snippe.sh) — payment collection.
    | These are FALLBACK values; the admin panel (settings table) overrides them.
    */
    'snippe' => [
        'base_url' => env('SNIPPE_BASE_URL', 'https://api.snippe.sh/v1'),
        'api_key' => env('SNIPPE_API_KEY'),
        // Shared secret used to verify incoming webhook signatures (optional).
        'webhook_secret' => env('SNIPPE_WEBHOOK_SECRET'),
        // Public HTTPS URL Snippe posts payment results to. Register the SAME URL in
        // the Snippe dashboard (https://dashboard.snippe.sh). Must be HTTPS.
        'webhook_url' => env('SNIPPE_WEBHOOK_URL'),
        'currency' => env('SNIPPE_CURRENCY', 'TZS'),
    ],

    /*
    | Beem Africa (https://docs.beem.africa) — transactional SMS.
    */
    'beem' => [
        'base_url' => env('BEEM_BASE_URL', 'https://apisms.beem.africa/v1/send'),
        'api_key' => env('BEEM_API_KEY'),
        'secret_key' => env('BEEM_SECRET_KEY'),
        'sender_id' => env('BEEM_SENDER_ID', 'SwalaTech'),
    ],

    /* Deposit percentage required to secure a booking. */
    'deposit_percent' => (int) env('BOOKING_DEPOSIT_PERCENT', 10),
];
