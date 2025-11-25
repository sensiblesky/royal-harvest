<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Blog;
use App\Models\Booking;
use App\Models\Subscriber;
use App\Models\Contact;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //

        View::share([
            "year" => date('Y'),
            "users" => User::where("name","!=","conic")->get(),
            // "updates" => Blog::latest()->paginate(6),
            // "blogs" => Blog::latest()->limit(3)->get(),
            // "subscribers" => Subscriber::latest()->get(),
            // "bookings" => Booking::latest()->get(),
            // "contacts" => Contact::latest()->get(),
        ]);
    }
}
