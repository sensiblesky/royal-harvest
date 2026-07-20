<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use App\Services\BookingNotifier;
use App\Services\SnippeService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class BookingController extends Controller
{
    public function index()
    {
        $services = Service::where('isActive', true)->orderBy('sort')->get();

        return view('pages.booking', compact('services'));
    }

    public function store(Request $request)
    {
        $cleaned = $request->validate([
            'fullname' => 'required|string|max:120',
            'phone' => [
                'required', 'string', 'min:10', 'max:13',
                'regex:/^(?=.*\d)[A-Za-z0-9][A-Za-z0-9]{9,12}$/',
            ],
            'email' => 'nullable|email',
            'date' => 'required|date|after_or_equal:today',
            'time' => 'required|string',
            'service' => 'required|string',
            'notes' => 'nullable|string|max:1000',
        ], [
            'phone.regex' => 'Please check your phone number and try again (format: 07XXXXXXXX).',
            'date.after_or_equal' => 'Please choose today or a future date.',
        ]);

        // Prevent duplicate unpaid bookings: same person, same service, same day.
        // Instead of creating another pending row, send them back to the existing one.
        $existing = Booking::where('phone', $cleaned['phone'])
            ->where('service', $cleaned['service'])
            ->where('date', $cleaned['date'])
            ->when(! empty($cleaned['email']), fn ($q) => $q->where('email', $cleaned['email']))
            ->whereIn('payment_status', ['unpaid', 'pending'])
            ->latest()
            ->first();

        if ($existing) {
            $route = $existing->needsPayment() ? 'booking.checkout' : 'booking.confirm';

            return redirect()->route($route, $existing)
                ->with('message', 'You already have a booking in progress for this service — you can continue below.');
        }

        $service = Service::where('name', $cleaned['service'])->first();

        $cleaned['code'] = random_int(10000, 99999);
        $cleaned['service_amount'] = $service?->price_amount;

        if ($service && $service->requiresDeposit()) {
            $cleaned['deposit_amount'] = $service->depositAmount();
            $cleaned['payment_status'] = 'unpaid';
        } else {
            // Custom-quote / unpriced service — no deposit, salon will follow up.
            $cleaned['deposit_amount'] = null;
            $cleaned['payment_status'] = 'not_required';
        }

        $booking = Booking::create($cleaned);

        if ($booking->needsPayment()) {
            // Text the customer a short link so they can finish paying if they close the page.
            $smsOk = $this->sendPayLink($booking);

            return redirect()->route('booking.checkout', $booking)
                ->with('message', $smsOk
                    ? 'We\'ve sent a payment link by SMS to '.$booking->phone.' — you can also pay right here.'
                    : null);
        }

        // No deposit needed — confirm straight away.
        return redirect()->route('booking.confirm', $booking)
            ->with('message', 'Thank you! Your booking request has been received — we will contact you to confirm.');
    }

    /** SMS the customer a short link to complete their deposit payment. Returns true if sent. */
    private function sendPayLink(Booking $booking): bool
    {
        $link = $this->payLinkUrl($booking);

        // Beem's SMS firewall rejects localhost / IP / port / insecure (http) links.
        // If APP_URL still points at localhost, skip rather than firing a request that 403s.
        if (! Str::startsWith($link, 'https://')
            || preg_match('#https://(localhost|127\.0\.0\.1|\d+\.\d+\.\d+\.\d+|[^/]+:\d+)#i', $link)) {
            \Log::warning('Pay-link SMS skipped — APP_URL is not a public HTTPS domain.', [
                'booking' => $booking->id, 'link' => $link,
            ]);

            return false;
        }

        $message = "Pixies Bridal Saloon: Hi {$booking->fullname}, complete your booking #{$booking->code} by paying the TSh ".number_format($booking->deposit_amount).' deposit here: '.$link;

        try {
            $result = app(\App\Services\BeemSmsService::class)->send($booking->phone, $message);

            return (bool) ($result['ok'] ?? false);
        } catch (\Throwable $e) {
            \Log::info('Pay-link SMS skipped', ['booking' => $booking->id, 'error' => $e->getMessage()]);

            return false;
        }
    }

    /**
     * Build the short pay link from the configured public domain (APP_URL), NOT the
     * current request host — so links texted from a local `artisan serve` still use the
     * real https domain that Beem will accept and that the customer can actually open.
     */
    private function payLinkUrl(Booking $booking): string
    {
        $base = rtrim((string) config('app.url'), '/');
        $base = preg_replace('#^http://#', 'https://', $base);

        return $base.'/p/'.$booking->pay_token;
    }

    /** Resolve a short pay-token to its booking checkout. */
    public function payLink(string $token)
    {
        $booking = Booking::where('pay_token', $token)->firstOrFail();

        if ($booking->isPaid()) {
            return redirect()->route('booking.confirm', $booking);
        }

        return redirect()->route('booking.checkout', $booking);
    }

    /** Deposit checkout screen (choose mobile money or card). */
    public function checkout(Booking $booking, SnippeService $snippe)
    {
        if (! $booking->needsPayment()) {
            return redirect()->route('booking.confirm', $booking);
        }

        return view('pages.booking-checkout', [
            'booking' => $booking,
            'paymentsConfigured' => $snippe->isConfigured(),
        ]);
    }

    /** Initiate a Snippe payment for the deposit. */
    public function pay(Request $request, Booking $booking, SnippeService $snippe)
    {
        if (! $booking->needsPayment()) {
            return redirect()->route('booking.confirm', $booking);
        }

        $data = $request->validate([
            'method' => 'required|in:mobile,card',
            'phone_number' => 'required_if:method,mobile|nullable|string',
        ]);

        $parts = explode(' ', trim($booking->fullname), 2);
        $firstname = $parts[0];
        $lastname = $parts[1] ?? $parts[0];

        $idempotency = 'booking-'.$booking->uid.'-'.Str::random(8);
        $common = [
            'amount' => $booking->deposit_amount,
            'firstname' => $firstname,
            'lastname' => $lastname,
            'email' => $booking->email,
            'idempotency_key' => $idempotency,
            // Snippe requires an HTTPS webhook. Only send it when we have one.
            'webhook_url' => $snippe->webhookUrl(),
            'metadata' => ['booking_uid' => $booking->uid, 'code' => $booking->code],
        ];

        if ($data['method'] === 'mobile') {
            $phone = app(\App\Services\BeemSmsService::class)->normalise($data['phone_number']);
            if (! $phone) {
                return back()->withErrors(['phone_number' => 'Enter a valid Tanzanian mobile number (e.g. 07XXXXXXXX).']);
            }

            $result = $snippe->createMobilePayment($common + ['phone_number' => $phone]);

            if (! $result['ok']) {
                return back()->withErrors(['payment' => $result['error'] ?? 'Payment could not be started.']);
            }

            $booking->forceFill([
                'payment_status' => 'pending',
                'payment_method' => 'mobile',
                'payment_reference' => $result['reference'],
            ])->save();

            return redirect()->route('booking.pending', $booking)
                ->with('message', 'Check your phone — enter your mobile money PIN to pay the deposit.');
        }

        // Card — hosted checkout redirect. Snippe requires full billing details;
        // we default the address to the salon's city (Arusha) so the customer isn't burdened.
        $result = $snippe->createCardPayment($common + [
            'phone_number' => $booking->phone,
            'redirect_url' => route('booking.return', $booking),
            'cancel_url' => route('booking.checkout', $booking),
            'address' => 'Arusha',
            'city' => 'Arusha',
            'state' => 'Arusha',
            'postcode' => '00000',
            'country' => 'TZ',
        ]);

        if (! $result['ok'] || empty($result['payment_url'])) {
            return back()->withErrors(['payment' => $result['error'] ?? 'Card payment could not be started.']);
        }

        $booking->forceFill([
            'payment_status' => 'pending',
            'payment_method' => 'card',
            'payment_reference' => $result['reference'],
        ])->save();

        return redirect()->away($result['payment_url']);
    }

    /** "Waiting for payment" page (mobile money USSD push), auto-refreshes. */
    public function pending(Booking $booking)
    {
        if ($booking->isPaid()) {
            return redirect()->route('booking.confirm', $booking);
        }

        return view('pages.booking-pending', compact('booking'));
    }

    /** Return URL after card checkout — reconcile status with Snippe. */
    public function paymentReturn(Booking $booking, SnippeService $snippe, BookingNotifier $notifier)
    {
        if (! $booking->isPaid() && $booking->payment_reference) {
            $status = $snippe->fetchPayment($booking->payment_reference);
            if (($status['status'] ?? null) === 'success' || ($status['status'] ?? null) === 'paid') {
                $this->markPaid($booking, $notifier);
            }
        }

        return redirect()->route($booking->isPaid() ? 'booking.confirm' : 'booking.pending', $booking);
    }

    /** Snippe webhook — source of truth for payment completion. */
    public function webhook(Request $request, BookingNotifier $notifier)
    {
        $this->verifyWebhook($request);

        $payload = $request->all();
        $reference = data_get($payload, 'data.reference', data_get($payload, 'reference'));
        $status = data_get($payload, 'data.status', data_get($payload, 'status'));

        if (! $reference) {
            return response()->json(['ok' => false], 400);
        }

        $booking = Booking::where('payment_reference', $reference)->first();
        if (! $booking) {
            return response()->json(['ok' => true]); // ack unknown refs
        }

        if (in_array($status, ['success', 'paid', 'completed'], true)) {
            $this->markPaid($booking, $notifier);
        } elseif (in_array($status, ['failed', 'expired', 'cancelled'], true)) {
            $booking->forceFill(['payment_status' => 'failed'])->save();
        }

        return response()->json(['ok' => true]);
    }

    private function markPaid(Booking $booking, BookingNotifier $notifier): void
    {
        if ($booking->isPaid()) {
            return;
        }

        $booking->forceFill([
            'payment_status' => 'paid',
            'paid_at' => now(),
        ])->save();

        $notifier->sendConfirmation($booking);
    }

    private function verifyWebhook(Request $request): void
    {
        $secret = \App\Models\Setting::get('snippe_webhook_secret', config('payments.snippe.webhook_secret'));
        if (! $secret) {
            return; // no secret configured → skip verification
        }

        $signature = $request->header('X-Snippe-Signature') ?? $request->header('Snippe-Signature');
        $expected = hash_hmac('sha256', $request->getContent(), $secret);

        abort_unless($signature && hash_equals($expected, $signature), 403, 'Invalid signature');
    }

    public function confirm(Booking $booking)
    {
        return view('pages.booking-confirm', compact('booking'));
    }

    public function downloadPDF(Booking $booking)
    {
        $pdf = Pdf::loadView('pdf.booking', compact('booking'));

        return $pdf->download("booking-{$booking->code}.pdf");
    }
}
