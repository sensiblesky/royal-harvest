<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;



Route::prefix("/")->
    // ->middleware('auth.check')
    group(function () {
        Route::get('', [HomeController::class, "home"])->name('home');
        Route::get('booking', [BookingController::class, "index"])->name('booking.index');
        Route::get('booking/confirm', [BookingController::class, "confirm"])->name('booking.confirm');
        Route::post('booking/store', [BookingController::class, "store"])->name('booking.store');
        Route::get('/bookings/{id}/download', [BookingController::class, "downloadPDF"])->name('booking.download');
    });



    
require __DIR__."/admin.php";