<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CandidateController;
use App\Http\Controllers\ProgrammeController;

Route::name('admin.')->prefix("/auth")
    ->middleware('auth.check')
    ->group(function () {
        Route::get('', [AdminController::class,'dashboard'])->name('index');

        //USERS
        Route::get('/users', [AdminController::class,'users'])->name('users.index');
        Route::get('/user/{user}', [AdminController::class,'removeUser'])->name('user.delete');
        Route::get('/users/add', [AdminController::class,'addUser'])->name('users.add');
        
        
        //bookings
        Route::get('/bookings/{status}', [AdminController::class,'bookings'])->name('bookings.index');
        Route::get('/remove/{booking}', [AdminController::class,'removeBooking'])->name('booking.delete');
        Route::get('/update/{booking}', [AdminController::class,'updateBooking'])->name('booking.update');
        Route::get('/bookings/clear', [AdminController::class,'clearBookings'])->name('bookings.clear');
        
        
        //UPDATES
        Route::get('/updates', [AdminController::class,'updates'])->name('updates.index');
        Route::post('/updates/add', [AdminController::class,'storeUpdates'])->name('updates.add');
        Route::get('/updates/clear', [AdminController::class,'clearUpdates'])->name('updates.clear');
        Route::get('/updates/update/{id}', [AdminController::class,'updateUpdate'])->name('update.update');
        Route::get('/updates/remove/{ID}', [AdminController::class,'removeUpdate'])->name('update.delete');


         //PROGRAMMES
        Route::get('/programmes', [ProgrammeController::class,'index'])->name('programmes.index');
        Route::post('/programmes', [ProgrammeController::class,'store'])->name('programmes.store');
        Route::post('/programmes/update/{programme}', [ProgrammeController::class,'update'])->name('programme.update');
        Route::get('/programmes/remove/{programme}', [ProgrammeController::class,'remove'])->name('programme.remove');
        Route::get('/programmes/status/{programme}', [ProgrammeController::class,'status'])->name('programme.status');
        Route::get('/programmes/clear', [ProgrammeController::class,'clear'])->name('programmes.clear');
        Route::post('/programmes/apply', [ProgrammeController::class,'apply'])->name('programmes.apply');
        Route::get('/programmes/restore', [ProgrammeController::class,'restore'])->name('programmes.restore');


        // CANDIDATES
        Route::get('/candidates', [CandidateController::class,'index'])->name('candidates.index');
        Route::get('/candidates/remove/{candidate}', [CandidateController::class,'destroy'])->name('candidate.delete');
        Route::get('/candidates/status/{candidate}', [CandidateController::class,'status'])->name('candidate.status');
        Route::get('/candidates/clear', [CandidateController::class,'clear'])->name('candidates.clear');
        
        
    });


 