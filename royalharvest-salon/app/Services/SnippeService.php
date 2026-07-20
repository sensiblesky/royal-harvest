<?php

namespace App\Services;

use App\Models\Setting;
use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

class SnippeService
{
    private string $baseUrl;
    private ?string $apiKey;
    private string $currency;

    public function __construct()
    {
        $this->baseUrl = rtrim(Setting::get('snippe_base_url', config('payments.snippe.base_url')), '/');
        $this->apiKey = Setting::get('snippe_api_key', config('payments.snippe.api_key'));
        $this->currency = Setting::get('snippe_currency', config('payments.snippe.currency', 'TZS'));
    }

    public function isConfigured(): bool
    {
        return ! empty($this->apiKey);
    }

    /**
     * The webhook URL to register with Snippe. Admin-configurable; must be HTTPS
     * (Snippe rejects non-HTTPS). Returns null when we don't have a valid HTTPS URL,
     * so we simply omit it from the payload (payment still works, reconciled on return).
     */
    public function webhookUrl(): ?string
    {
        $url = Setting::get('snippe_webhook_url', config('payments.snippe.webhook_url'));

        if ($url && Str::startsWith($url, 'https://')) {
            return $url;
        }

        return null;
    }

    private function client(string $idempotencyKey): PendingRequest
    {
        return Http::withToken($this->apiKey)
            ->acceptJson()
            ->asJson()
            ->withHeaders(['Idempotency-Key' => $idempotencyKey])
            ->timeout(30)
            ->baseUrl($this->baseUrl);
    }

    /**
     * Create a mobile-money payment intent (USSD push).
     * Returns ['ok'=>bool, 'reference'=>?string, 'status'=>?string, 'error'=>?string, 'raw'=>array]
     */
    public function createMobilePayment(array $params): array
    {
        $payload = [
            'payment_type' => 'mobile',
            'phone_number' => $params['phone_number'],
            'details' => [
                'amount' => (int) $params['amount'], // smallest unit (TZS has no subunit → whole shillings)
                'currency' => $this->currency,
            ],
            'customer' => [
                'firstname' => $params['firstname'],
                'lastname' => $params['lastname'],
                'email' => $params['email'] ?: 'noreply@pixiesbridal.co.tz',
            ],
            'webhook_url' => $params['webhook_url'] ?? null,
            'metadata' => $params['metadata'] ?? [],
        ];

        return $this->send($payload, $params['idempotency_key']);
    }

    /**
     * Create a hosted card payment. Returns a payment_url for redirect.
     */
    public function createCardPayment(array $params): array
    {
        $payload = [
            'payment_type' => 'card',
            'details' => [
                'amount' => (int) $params['amount'],
                'currency' => $this->currency,
                'redirect_url' => $params['redirect_url'],
                'cancel_url' => $params['cancel_url'],
            ],
            'customer' => [
                'firstname' => $params['firstname'],
                'lastname' => $params['lastname'],
                'email' => $params['email'] ?: 'noreply@pixiesbridal.co.tz',
                // Snippe requires full billing details for card payments.
                'address' => $params['address'] ?? 'Arusha',
                'city' => $params['city'] ?? 'Arusha',
                'state' => $params['state'] ?? 'Arusha',
                'postcode' => $params['postcode'] ?? '00000',
                'country' => $params['country'] ?? 'TZ',
            ],
            'phone_number' => $params['phone_number'] ?? null,
            'webhook_url' => $params['webhook_url'] ?? null,
            'metadata' => $params['metadata'] ?? [],
        ];

        return $this->send($payload, $params['idempotency_key']);
    }

    private function send(array $payload, string $idempotencyKey): array
    {
        if (! $this->isConfigured()) {
            return ['ok' => false, 'error' => 'Payments are not configured. Please contact the salon.', 'raw' => []];
        }

        try {
            $response = $this->client($idempotencyKey)->post('/payments', array_filter($payload, fn ($v) => $v !== null));
        } catch (\Throwable $e) {
            Log::error('Snippe request failed', ['message' => $e->getMessage()]);

            return ['ok' => false, 'error' => 'Could not reach the payment provider. Please try again.', 'raw' => []];
        }

        $body = $response->json() ?? [];

        if (! $response->successful()) {
            Log::warning('Snippe payment error', ['status' => $response->status(), 'body' => $body]);

            return [
                'ok' => false,
                'error' => data_get($body, 'message', 'Payment could not be started.'),
                'raw' => $body,
            ];
        }

        $data = data_get($body, 'data', $body);

        return [
            'ok' => true,
            'reference' => data_get($data, 'reference'),
            'status' => data_get($data, 'status', 'pending'),
            'payment_url' => data_get($data, 'payment_url'),
            'raw' => $body,
        ];
    }

    /**
     * Fetch a payment's current status from Snippe (used to reconcile after redirect).
     */
    public function fetchPayment(string $reference): array
    {
        if (! $this->isConfigured()) {
            return ['ok' => false, 'status' => null];
        }

        try {
            $response = Http::withToken($this->apiKey)->acceptJson()
                ->timeout(20)->baseUrl($this->baseUrl)->get("/payments/{$reference}");
        } catch (\Throwable $e) {
            return ['ok' => false, 'status' => null];
        }

        $data = data_get($response->json(), 'data', $response->json() ?? []);

        return [
            'ok' => $response->successful(),
            'status' => data_get($data, 'status'),
            'raw' => $response->json() ?? [],
        ];
    }
}
