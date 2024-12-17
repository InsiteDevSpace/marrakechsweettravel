<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\ClientController;
use App\Http\Controllers\CurrencyController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\ReservationTransferController;
use App\Http\Controllers\TransferController;
use App\Http\Controllers\ServiceAvailabilityController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Static and specific routes
Route::get('/', [HomeController::class, 'index'])->name('pages.home');
Route::get('/a-propos', function () {
    return view('pages.about');
});
Route::get('/contact', function () {
    return view('pages.contact');
});
Route::get('/faire-un-don', function () {
    return view('pages.donation');
});
Route::get('/conditions-generales', function () {
    return view('pages.conditions-generales');
});
Route::post('/donate', [DonationController::class, 'donate'])->name('donations.donate');

// Authentication routes
Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

// Auth-specific routes (login, register, etc.)
require __DIR__ . '/auth.php';

// Middleware-protected routes
Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');

    // CRUD routes
    Route::resource('users', UserController::class);
    Route::resource('clients', ClientController::class);
    Route::resource('reservation_transfers', ReservationTransferController::class);

    Route::resource('categories', CategoriesController::class);
    Route::resource('posts', PostsController::class);
    Route::resource('transfers', TransferController::class);
    Route::resource('members', MembersController::class);
    Route::resource('donations', DonationController::class);
    Route::resource('services', ServiceController::class);
    Route::resource('service_availability', ServiceAvailabilityController::class);
    Route::resource('reservations', ReservationController::class);
    Route::get('/services/{id}/availability', [ServiceController::class, 'getAvailability']);


});



Route::get('/set-currency', [CurrencyController::class, 'setCurrency'])->name('set.currency');

Route::get('/set-currency', function (Request $request) {
    $currency = $request->get('currency', 'USD'); // Default to USD
    session(['currency' => $currency]); // Store the currency in the session
    return response()->json(['success' => true]);
});


// Generic slug-based route (make sure to exclude known paths)
Route::get('/{slug}', [ServiceController::class, 'showService'])
    ->where('slug', '^(?!login|register|password|dashboard|profile|api|logout).*$')
    ->name('services.showService');
