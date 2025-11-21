<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;


Route::name('admin.')->prefix("/royal/auth")
    // ->middleware('auth.check')
    ->group(function () {
        Route::get('', [AdminController::class,'dashboard'])->name('index');

        //USERS
        Route::get('/users', [AdminController::class,'users'])->name('users.index');
        Route::get('/user/{user}', [AdminController::class,'removeUser'])->name('user.delete');
        Route::get('/users/add', [AdminController::class,'addUser'])->name('users.add');
        
        
        //PROMOTIONS/HERO
        Route::get('/promotions', [AdminController::class,'promotions'])->name('promotions.index');
        Route::post('/promotions', [AdminController::class,'storePromotions'])->name('promotions.add');
        Route::get('/remove/{promotion}', [AdminController::class,'removePromotion'])->name('promotion.delete');
        Route::get('/promotions/clear', [AdminController::class,'clearPromotions'])->name('promotions.clear');
        Route::get('/promotions/{promotion}', [AdminController::class,'updatePromotion'])->name('promotion.update');
        
        
        //CONTACT
        Route::get('/contacts', [AdminController::class,'contacts'])->name('contacts.index');
        Route::post('/contacts', [AdminController::class,'storeContact'])->name('contacts.add');
        Route::get('/contact/{contact}', [AdminController::class,'removeContact'])->name('contact.delete');
        Route::get('/contact/clear', [AdminController::class,'clearContacts'])->name('contacts.clear');


        //UPDATES
        Route::get('/updates', [AdminController::class,'updates'])->name('updates.index');
        Route::post('/updates', [AdminController::class,'storeUpdates'])->name('updates.add');
        Route::get('/updates/remove/{id}', [AdminController::class,'removeUpdate'])->name('update.delete');
        Route::get('/updates/modify/{id}', [AdminController::class,'updateUpdate'])->name('update.update');
        Route::get('/updates/show/{id}', [AdminController::class,'showUpdate'])->name('update.show');
        Route::get('/blog/clear', [AdminController::class,'clearUpdates'])->name('updates.clear');


        //SUBSCRIBERs
        Route::get('/subscribers', [AdminController::class,'subscribers'])->name('subscribers.index');
        Route::post('/subscribers', [AdminController::class,'storeSubscriber'])->name('subscribers.add');
        Route::get('/subscribers/{subscriber}', [AdminController::class,'removeSubscriber'])->name('subscriber.delete');
        Route::get('/subscribers/clear', [AdminController::class,'clearSubscribers'])->name('subscriber.clear');


    });