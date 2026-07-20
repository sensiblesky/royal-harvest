<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Contact;
use App\Models\Enquiry;
use App\Models\Service;
use App\Models\Setting;
use App\Models\Subscriber;
use App\Services\BeemSmsService;
use App\Services\SnippeService;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function dashboard()
    {
        $stats = [
            'bookings' => Booking::count(),
            'pending' => Booking::where('isDone', false)->count(),
            'enquiries' => Enquiry::where('handled', false)->count(),
            'paid' => Booking::where('payment_status', 'paid')->count(),
        ];
        $recent = Booking::latest()->take(6)->get();

        return view('admin.dashboard', compact('stats', 'recent'));
    }

    /* ---------------- Bookings ---------------- */
    public function bookings(Request $request)
    {
        $filter = $request->query('status', 'all');
        $query = Booking::latest();
        if ($filter === 'pending') {
            $query->where('isDone', false);
        } elseif ($filter === 'done') {
            $query->where('isDone', true);
        }

        return view('admin.bookings', [
            'bookings' => $query->paginate(15)->withQueryString(),
            'filter' => $filter,
        ]);
    }

    public function toggleBooking(Booking $booking)
    {
        $booking->update(['isDone' => ! $booking->isDone]);

        return back()->with('message', 'Booking status updated.');
    }

    public function removeBooking(Booking $booking)
    {
        $booking->delete();

        return back()->with('message', 'Booking removed.');
    }

    /* ---------------- Services ---------------- */
    public function services()
    {
        return view('admin.services', ['services' => Service::orderBy('sort')->get()]);
    }

    public function storeService(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'tagline' => 'nullable|string|max:160',
            'description' => 'nullable|string|max:600',
            'price' => 'nullable|string|max:60',
            'price_amount' => 'nullable|integer|min:0',
            'duration' => 'nullable|string|max:60',
            'icon' => 'nullable|string|max:40',
            'sort' => 'nullable|integer',
        ]);
        Service::create($data);

        return back()->with('message', 'Service added.');
    }

    public function updateService(Request $request, Service $service)
    {
        $data = $request->validate([
            'name' => 'required|string|max:120',
            'tagline' => 'nullable|string|max:160',
            'description' => 'nullable|string|max:600',
            'price' => 'nullable|string|max:60',
            'price_amount' => 'nullable|integer|min:0',
            'duration' => 'nullable|string|max:60',
            'icon' => 'nullable|string|max:40',
            'sort' => 'nullable|integer',
        ]);
        $service->update($data);

        return back()->with('message', 'Service updated.');
    }

    public function toggleService(Service $service)
    {
        $service->update(['isActive' => ! $service->isActive]);

        return back()->with('message', 'Service visibility updated.');
    }

    public function removeService(Service $service)
    {
        $service->delete();

        return back()->with('message', 'Service removed.');
    }

    /* ---------------- Contacts & Subscribers ---------------- */
    public function contacts()
    {
        return view('admin.contacts', ['contacts' => Contact::latest()->paginate(15)]);
    }

    public function removeContact(Contact $contact)
    {
        $contact->delete();

        return back()->with('message', 'Message removed.');
    }

    public function subscribers()
    {
        return view('admin.subscribers', ['subscribers' => Subscriber::latest()->paginate(30)]);
    }

    /* ---------------- Enquiries (no-deposit callbacks) ---------------- */
    public function enquiries()
    {
        return view('admin.enquiries', ['enquiries' => Enquiry::latest()->paginate(20)]);
    }

    public function toggleEnquiry(Enquiry $enquiry)
    {
        $enquiry->update(['handled' => ! $enquiry->handled]);

        return back()->with('message', 'Enquiry updated.');
    }

    public function removeEnquiry(Enquiry $enquiry)
    {
        $enquiry->delete();

        return back()->with('message', 'Enquiry removed.');
    }

    /* ---------------- Payment & SMS settings ---------------- */
    public function settings(SnippeService $snippe, BeemSmsService $sms)
    {
        return view('admin.settings', [
            'snippeConfigured' => $snippe->isConfigured(),
            'smsConfigured' => $sms->isConfigured(),
            'depositPercent' => Service::DEPOSIT_PERCENT,
            'settings' => [
                'snippe_base_url' => Setting::get('snippe_base_url', config('payments.snippe.base_url')),
                'snippe_currency' => Setting::get('snippe_currency', config('payments.snippe.currency')),
                'snippe_webhook_url' => Setting::get('snippe_webhook_url', config('payments.snippe.webhook_url')),
                'snippe_webhook_secret_set' => Setting::has('snippe_webhook_secret') || config('payments.snippe.webhook_secret'),
                'snippe_api_key_set' => Setting::has('snippe_api_key') || config('payments.snippe.api_key'),
                'beem_api_key_set' => Setting::has('beem_api_key') || config('payments.beem.api_key'),
                'beem_secret_key_set' => Setting::has('beem_secret_key') || config('payments.beem.secret_key'),
                'beem_sender_id' => Setting::get('beem_sender_id', config('payments.beem.sender_id')),
                'admin_alert_phone' => Setting::get('admin_alert_phone'),
            ],
        ]);
    }

    public function updateSettings(Request $request)
    {
        $data = $request->validate([
            'snippe_base_url' => 'nullable|url',
            'snippe_api_key' => 'nullable|string|max:255',
            'snippe_webhook_url' => 'nullable|url|starts_with:https://',
            'snippe_webhook_secret' => 'nullable|string|max:255',
            'snippe_currency' => 'nullable|string|max:8',
            'beem_api_key' => 'nullable|string|max:255',
            'beem_secret_key' => 'nullable|string|max:512',
            'beem_sender_id' => 'nullable|string|max:20',
            'admin_alert_phone' => 'nullable|string|max:20',
        ], [
            'snippe_webhook_url.starts_with' => 'The webhook URL must be HTTPS (Snippe requires it).',
        ]);

        // Only overwrite secrets when a new value is actually provided (blank = keep existing).
        $secretKeys = ['snippe_api_key', 'snippe_webhook_secret', 'beem_api_key', 'beem_secret_key'];
        foreach ($data as $key => $value) {
            if (in_array($key, $secretKeys, true) && ($value === null || $value === '')) {
                continue;
            }
            Setting::put($key, $value);
        }

        return back()->with('message', 'Payment & SMS settings saved.');
    }

    /** Send a test SMS to verify Beem credentials. */
    public function testSms(Request $request, BeemSmsService $sms)
    {
        $request->validate(['test_phone' => 'required|string|max:20']);

        $result = $sms->send($request->test_phone, 'Pixies Bridal Saloon: test message - your SMS setup is working. Asante!');

        return back()->with(
            $result['ok'] ? 'message' : 'error',
            $result['ok'] ? 'Test SMS sent successfully.' : ('Test SMS failed: '.($result['error'] ?? 'unknown error'))
        );
    }
}
