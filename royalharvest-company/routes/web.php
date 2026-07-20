<?php

use App\Http\Controllers\AccountController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProgrammeController;
use Illuminate\Support\Facades\Route;

/* ---------------- Public ---------------- */
Route::get('/', [PageController::class, 'home'])->name('home');
Route::get('/about', [PageController::class, 'about'])->name('about');

Route::get('/programmes', [ProgrammeController::class, 'index'])->name('programmes');
Route::get('/apply', [ProgrammeController::class, 'apply'])->name('apply');
Route::post('/apply', [ProgrammeController::class, 'store'])->name('apply.store');

Route::get('/blog', [BlogController::class, 'index'])->name('blogs');
Route::get('/blog/{blog}', [BlogController::class, 'show'])->name('blogs.show');

Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::post('/contact', [ContactController::class, 'store'])->name('contact.store');

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

    Route::get('/ventures', [AdminController::class, 'ventures'])->name('ventures');
    Route::post('/ventures', [AdminController::class, 'storeVenture'])->name('ventures.store');
    Route::patch('/ventures/{venture}', [AdminController::class, 'updateVenture'])->name('ventures.update');
    Route::patch('/ventures/{venture}/toggle', [AdminController::class, 'toggleVenture'])->name('ventures.toggle');
    Route::delete('/ventures/{venture}', [AdminController::class, 'removeVenture'])->name('ventures.remove');

    Route::get('/programmes', [AdminController::class, 'programmes'])->name('programmes');
    Route::post('/programmes', [AdminController::class, 'storeProgramme'])->name('programmes.store');
    Route::patch('/programmes/{programme}', [AdminController::class, 'updateProgramme'])->name('programmes.update');
    Route::patch('/programmes/{programme}/toggle', [AdminController::class, 'toggleProgramme'])->name('programmes.toggle');
    Route::delete('/programmes/{programme}', [AdminController::class, 'removeProgramme'])->name('programmes.remove');

    Route::get('/candidates', [AdminController::class, 'candidates'])->name('candidates');
    Route::patch('/candidates/{candidate}/toggle', [AdminController::class, 'toggleCandidate'])->name('candidates.toggle');
    Route::delete('/candidates/{candidate}', [AdminController::class, 'removeCandidate'])->name('candidates.remove');

    Route::get('/blogs', [AdminController::class, 'blogs'])->name('blogs');
    Route::post('/blogs', [AdminController::class, 'storeBlog'])->name('blogs.store');
    Route::delete('/blogs/{blog}', [AdminController::class, 'removeBlog'])->name('blogs.remove');

    Route::get('/contacts', [AdminController::class, 'contacts'])->name('contacts');
    Route::delete('/contacts/{contact}', [AdminController::class, 'removeContact'])->name('contacts.remove');
});

// SEO sitemap
Route::get('/sitemap.xml', function () {
    $urls = collect([
        ['loc' => route('home'), 'priority' => '1.0'],
        ['loc' => route('about'), 'priority' => '0.7'],
        ['loc' => route('programmes'), 'priority' => '0.9'],
        ['loc' => route('apply'), 'priority' => '0.8'],
        ['loc' => route('blogs'), 'priority' => '0.6'],
        ['loc' => route('contact'), 'priority' => '0.6'],
    ]);
    foreach (\App\Models\Blog::latest()->get() as $post) {
        $urls->push(['loc' => route('blogs.show', $post), 'priority' => '0.5']);
    }

    return response()
        ->view('sitemap', ['urls' => $urls])
        ->header('Content-Type', 'application/xml');
})->name('sitemap');
