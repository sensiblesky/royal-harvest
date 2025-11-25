<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::name('admin.')->prefix("/auth")
    ->middleware('auth.check')
    ->group(function () {
        Route::get('', [AdminController::class,'dashboard'])->name('index');

        //USERS
        Route::get('/users', [AdminController::class,'users'])->name('users.index');
        Route::get('/user/{user}', [AdminController::class,'removeUser'])->name('user.delete');
        Route::get('/users/add', [AdminController::class,'addUser'])->name('users.add');
        
        
        //PROMOTIONS/HERO
        Route::get('/bookings/{status}', [AdminController::class,'bookings'])->name('bookings.index');
        Route::get('/remove/{booking}', [AdminController::class,'removeBooking'])->name('booking.delete');
        Route::get('/update/{booking}', [AdminController::class,'updateBooking'])->name('booking.update');
        Route::get('/bookings/clear', [AdminController::class,'clearBookings'])->name('bookings.clear');

    });