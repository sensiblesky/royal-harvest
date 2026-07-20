<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class BeemSmsService
{
    private string $url;
    private ?string $apiKey;
    private ?string $secretKey;
    private string $senderId;

    public function __construct()
    {
        $this->url = Setting::get('beem_base_url', config('payments.beem.base_url'));
        $this->apiKey = Setting::get('beem_api_key', config('payments.beem.api_key'));
        $this->secretKey = Setting::get('beem_secret_key', config('payments.beem.secret_key'));
        $this->senderId = Setting::get('beem_sender_id', config('payments.beem.sender_id', 'SwalaTech'));
    }

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey) && ! empty($this->secretKey);
    }

    /**
     * Send a single SMS. Phone is normalised to Beem's 2557XXXXXXXX format.
     * Returns ['ok'=>bool, 'error'=>?string].
     */
    public function send(string $phone, string $message): array
    {
        if (! $this->isConfigured()) {
            Log::info('Beem SMS skipped — not configured', ['phone' => $phone]);

            return ['ok' => false, 'error' => 'SMS not configured'];
        }

        $dest = $this->normalise($phone);
        if (! $dest) {
            return ['ok' => false, 'error' => 'Invalid phone number'];
        }

        $payload = [
            'source_addr' => $this->senderId,
            'encoding' => 0, // plain GSM-7 (cheapest); message is sanitised to ASCII below
            'message' => $this->sanitise($message),
            'recipients' => [
                ['recipient_id' => 1, 'dest_addr' => $dest],
            ],
        ];

        try {
            $response = Http::withBasicAuth($this->apiKey, $this->secretKey)
                ->acceptJson()->asJson()->timeout(30)
                ->post($this->url, $payload);
        } catch (\Throwable $e) {
            Log::error('Beem SMS request failed', ['message' => $e->getMessage()]);

            return ['ok' => false, 'error' => 'SMS provider unreachable'];
        }

        $json = $response->json();

        // Beem can return errors either as a non-2xx status OR as a 2xx body with
        // successful=false / code != 100. Treat both as failures.
        $accepted = $response->successful()
            && (data_get($json, 'successful') === true || (int) data_get($json, 'code') === 100);

        if (! $accepted) {
            Log::warning('Beem SMS error', [
                'status' => $response->status(),
                'body' => $response->body(), // raw body (may be non-JSON)
            ]);

            return [
                'ok' => false,
                'error' => data_get($json, 'message', 'SMS was rejected by the provider (HTTP '.$response->status().').'),
            ];
        }

        return ['ok' => true];
    }

    /**
     * Normalise a Tanzanian phone number to 2557XXXXXXXX (Beem format).
     * Accepts 07XXXXXXXX, 7XXXXXXXX, +2557XXXXXXXX, 2557XXXXXXXX.
     */
    public function normalise(string $phone): ?string
    {
        $digits = preg_replace('/\D+/', '', $phone);

        if (str_starts_with($digits, '0')) {
            $digits = '255'.substr($digits, 1);
        } elseif (str_starts_with($digits, '255')) {
            // already correct
        } elseif (strlen($digits) === 9) { // e.g. 7XXXXXXXX
            $digits = '255'.$digits;
        }

        return preg_match('/^255\d{9}$/', $digits) ? $digits : null;
    }

    /**
     * Convert common Unicode punctuation to GSM-7-safe ASCII and strip anything
     * left that isn't plain text, so Beem accepts the message without Unicode mode.
     */
    public function sanitise(string $message): string
    {
        $map = [
            '—' => '-', '–' => '-', '−' => '-',           // dashes
            '“' => '"', '”' => '"', '„' => '"', '«' => '"', '»' => '"',
            '‘' => "'", '’' => "'", '‚' => "'",           // quotes/apostrophes
            '…' => '...', '•' => '-', '·' => '.', '×' => 'x',
            '✓' => '', '✔' => '', '→' => '->', '←' => '<-',
            "\u{00A0}" => ' ',                             // non-breaking space
            'TSh' => 'TZS',                               // avoid odd rendering, keep ASCII
        ];
        $message = strtr($message, $map);

        // Transliterate any remaining accented characters to ASCII.
        if (function_exists('iconv')) {
            $converted = @iconv('UTF-8', 'ASCII//TRANSLIT//IGNORE', $message);
            if ($converted !== false) {
                $message = $converted;
            }
        }

        // Drop any non-printable/remaining non-ASCII bytes.
        $message = preg_replace('/[^\x20-\x7E\r\n]/', '', $message);

        return trim($message);
    }
}
