<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\EnquiryController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SubscriberController;
use Illuminate\Support\Facades\Route;

/* ---------------- Public ---------------- */
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/services', [PageController::class, 'services'])->name('services');
Route::get('/gallery', [PageController::class, 'gallery'])->name('gallery');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

Route::get('/booking', [BookingController::class, 'index'])->name('booking');
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booking/{booking}/checkout', [BookingController::class, 'checkout'])->name('booking.checkout');
Route::post('/booking/{booking}/pay', [BookingController::class, 'pay'])->name('booking.pay');
Route::get('/booking/{booking}/pending', [BookingController::class, 'pending'])->name('booking.pending');
Route::get('/booking/{booking}/return', [BookingController::class, 'paymentReturn'])->name('booking.return');
Route::get('/booking/{booking}/confirm', [BookingController::class, 'confirm'])->name('booking.confirm');
Route::get('/booking/{booking}/download', [BookingController::class, 'downloadPDF'])->name('booking.download');

// Short SMS pay link — resolves an opaque token to the booking checkout.
Route::get('/p/{token}', [BookingController::class, 'payLink'])->name('booking.pay-link');

// Snippe webhook (no auth, CSRF-exempt)
Route::post('/webhooks/snippe', [BookingController::class, 'webhook'])->name('booking.webhook');

// No-deposit enquiry fallback
Route::post('/enquiry', [EnquiryController::class, 'store'])->name('enquiry.store');

Route::post('/subscribe', [SubscriberController::class, 'store'])->name('subscribe');

/* ---------------- Auth ---------------- */
Route::get('/login', [AccountController::class, 'login'])->name('login')->middleware('guest');
Route::post('/login', [AccountController::class, 'authenticate'])->name('login.attempt')->middleware('guest');
Route::post('/logout', [AccountController::class, 'logout'])->name('logout')->middleware('auth');

/* ---------------- Admin ---------------- */
Route::prefix('admin')->name('admin.')->middleware('auth')->group(function () {
    Route::get('/', [AdminController::class, 'dashboard'])->name('index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile');
    Route::patch('/profile', [ProfileController::class, 'updateProfile'])->name('profile.update');
    Route::patch('/profile/password', [ProfileController::class, 'updatePassword'])->name('profile.password');

    Route::get('/bookings', [AdminController::class, 'bookings'])->name('bookings');
    Route::patch('/bookings/{booking}/toggle', [AdminController::class, 'toggleBooking'])->name('bookings.toggle');
    Route::delete('/bookings/{booking}', [AdminController::class, 'removeBooking'])->name('bookings.remove');

    Route::get('/services', [AdminController::class, 'services'])->name('services');
    Route::post('/services', [AdminController::class, 'storeService'])->name('services.store');
    Route::patch('/services/{service}', [AdminController::class, 'updateService'])->name('services.update');
    Route::patch('/services/{service}/toggle', [AdminController::class, 'toggleService'])->name('services.toggle');
    Route::delete('/services/{service}', [AdminController::class, 'removeService'])->name('services.remove');

    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::delete('/contacts/{contact}', [AdminController::class, 'removeContact'])->name('contacts.remove');

    Route::get('/enquiries', [AdminController::class, 'enquiries'])->name('enquiries');
    Route::patch('/enquiries/{enquiry}/toggle', [AdminController::class, 'toggleEnquiry'])->name('enquiries.toggle');
    Route::delete('/enquiries/{enquiry}', [AdminController::class, 'removeEnquiry'])->name('enquiries.remove');

    Route::get('/subscribers', [AdminController::class, 'subscribers'])->name('subscribers');

    Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    Route::post('/settings', [AdminController::class, 'updateSettings'])->name('settings.update');
    Route::post('/settings/test-sms', [AdminController::class, 'testSms'])->name('settings.test-sms');
});

// SEO sitemap
Route::get('/sitemap.xml', function () {
    $urls = collect([
        ['loc' => route('home'), 'priority' => '1.0'],
        ['loc' => route('services'), 'priority' => '0.9'],
        ['loc' => route('gallery'), 'priority' => '0.7'],
        ['loc' => route('about'), 'priority' => '0.6'],
        ['loc' => route('contact'), 'priority' => '0.6'],
        ['loc' => route('booking'), 'priority' => '0.9'],
    ]);

    return response()
        ->view('sitemap', ['urls' => $urls])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');
