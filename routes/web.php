<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\LanguageController;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Session;

Route::prefix("/")
    // ->middleware('auth.check')
    ->group(function () {
        Route::get('', [HomeController::class, "home"])->name('home');
        Route::get('booking', [BookingController::class, "index"])->name('booking.index');
        Route::get('booking/confirm', [BookingController::class, "confirm"])->name('booking.confirm');
         Route::get('school/apply', [BookingController::class, "indexApply"])->name('apply.index');
        Route::get('programme-offered', [BookingController::class, "programme"])->name('programme');
        Route::post('booking/store', [BookingController::class, "store"])->name('booking.store');
        Route::get('/bookings/{id}/download', [BookingController::class, "downloadPDF"])->name('booking.download');
        Route::get('language/{lang}', [LanguageController::class, 'switchLanguage'])->name('change.language');
        Route::post('/candidates/apply', [CandidateController::class,'apply'])->name('candidate.apply');
    });

    Route::get('/test-locale', function () {
    Session::put('locale', 'sw');
    App::setLocale('sw');

    return [
        'app_locale' => app()->getLocale(),
        'session_locale' => session('locale'),
        'translation' => __('messages.change_language'),
    ];
    });


Route::name('account.')->prefix('/account')->group(function(){
    Route::get('/login',[AccountController::class,'login'])->name("login");
    Route::post('/auth',[AccountController::class,'authenticate'])->name("auth");
    Route::get('/logout',[AccountController::class,'logout'])->name("logout")->middleware('auth');
});

Route::name('blogs.')->prefix('/blogs')->group(function(){
    Route::get('',[BlogController::class,'index'])->name("index");
    Route::get('show/{id}',[BlogController::class,'show'])->name("show");
    // Route::get('',[BlogController::class,'index'])->name("index")->middleware('auth.check');
});
Route::name('about.')->prefix('/about')->group(function(){
    Route::get('',[HomeController::class,'about'])->name("index");
});
    
require __DIR__."/admin.php";