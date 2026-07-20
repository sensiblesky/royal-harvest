<?php

namespace App\Services;

use App\Models\Booking;
use App\Models\Setting;
use Illuminate\Support\Facades\Log;

class BookingNotifier
{
    public function __construct(private BeemSmsService $sms) {}

    /**
     * On a confirmed (paid) booking, notify BOTH:
     *   1. the customer — a confirmation receipt SMS
     *   2. the salon admin — an alert to the admin phone configured in settings
     * Each is idempotent so a repeated webhook won't double-send.
     */
    public function sendConfirmation(Booking $booking): void
    {
        $this->notifyCustomer($booking);
        $this->notifyAdmin($booking);
    }

    private function notifyCustomer(Booking $booking): void
    {
        if ($booking->sms_sent) {
            return;
        }

        $date = \Carbon\Carbon::parse($booking->date)->format('j M Y');
        $paid = $booking->deposit_amount ? ' Deposit paid: TSh '.number_format($booking->deposit_amount).'.' : '';
        $message = "Pixies Bridal Saloon: Hi {$booking->fullname}, your booking #{$booking->code} for {$booking->service} on {$date} at {$booking->time} is CONFIRMED.{$paid} Asante!";

        if ($this->trySend($booking->phone, $message, 'customer', $booking)) {
            $booking->forceFill(['sms_sent' => true])->save();
        }
    }

    private function notifyAdmin(Booking $booking): void
    {
        if ($booking->admin_sms_sent) {
            return;
        }

        $adminPhone = Setting::get('admin_alert_phone');
        if (! $adminPhone) {
            return; // no admin phone configured — nothing to alert
        }

        $date = \Carbon\Carbon::parse($booking->date)->format('j M Y');
        $amount = $booking->deposit_amount ? 'TSh '.number_format($booking->deposit_amount) : 'a deposit';
        $message = "Royal Harvest ALERT: New PAID booking #{$booking->code} - {$booking->fullname} ({$booking->phone}) for {$booking->service} on {$date} {$booking->time}. Paid {$amount}. Login to confirm.";

        if ($this->trySend($adminPhone, $message, 'admin', $booking)) {
            $booking->forceFill(['admin_sms_sent' => true])->save();
        }
    }

    private function trySend(string $phone, string $message, string $who, Booking $booking): bool
    {
        try {
            $result = $this->sms->send($phone, $message);
            if (! ($result['ok'] ?? false)) {
                Log::info("Booking {$who} SMS not sent", ['booking' => $booking->id, 'error' => $result['error'] ?? null]);
            }

            return (bool) ($result['ok'] ?? false);
        } catch (\Throwable $e) {
            Log::error("Booking {$who} SMS threw", ['booking' => $booking->id, 'message' => $e->getMessage()]);

            return false;
        }
    }
}
