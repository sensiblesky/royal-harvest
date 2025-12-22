<?php

use App\Http\Controllers\BookingController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AccountController;
use App\Http\Controllers\BlogController;
use Illuminate\Support\Facades\Route;



Route::prefix("/")
    // ->middleware('auth.check')
    ->group(function () {
        Route::get('', [HomeController::class, "home"])->name('home');
        Route::get('booking', [BookingController::class, "index"])->name('booking.index');
        Route::get('booking/confirm', [BookingController::class, "confirm"])->name('booking.confirm');
        Route::post('booking/store', [BookingController::class, "store"])->name('booking.store');
        Route::get('/bookings/{id}/download', [BookingController::class, "downloadPDF"])->name('booking.download');
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
    
require __DIR__."/admin.php";