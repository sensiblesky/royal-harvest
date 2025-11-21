<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::prefix("/")->
    // ->middleware('auth.check')
    group(function () {
        Route::get('', [HomeController::class, "home"])->name('home');
        Route::get('booking', [BookingController::class, "index"])->name('booking.index');
        Route::post('booking/store', [BookingController::class, "store"])->name('booking.store');
    });



    
require __DIR__."/admin.php";