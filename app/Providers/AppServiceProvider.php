<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;
use App\Models\User;
use App\Models\Promotion;
use App\Models\Blog;
use App\Models\Booking;
use App\Models\Candidate;
use App\Models\Subscriber;
use App\Models\Contact;
use App\Models\Programme;

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
            // "programmes" => Programme::latest()->paginate(10),
            // "candidates" => Candidate::latest()->paginate(10),
            "updates" => Blog::latest()->paginate(6),
            // "candidates" => Candidate::latest()->paginate(6),
            "articles" => Blog::latest()->limit(5)->get(),
            // "subscribers" => Subscriber::latest()->get(),
            "bookings" => Booking::latest()->get(),
            // "contacts" => Contact::latest()->get(),
        ]);
    }
}
