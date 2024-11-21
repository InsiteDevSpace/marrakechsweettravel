<?php

use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\LanguageController;
use App\Http\Controllers\MembersController;
use App\Http\Controllers\PostsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DonationController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {return view('pages.home');});
Route::get('/a-propos', function () {return view('pages.about');});
Route::get('/contact', function () {return view('pages.contact');});
Route::get('/faire-un-don', function () {return view('pages.donation');});
Route::get('/conditions-generales', function () {return view('pages.conditions-generales');});
Route::post('/donate', [DonationController::class, 'donate'])->name('donations.donate');




Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    // Profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('language/{lang}', [LanguageController::class, 'switchLang'])->name('language.switch');
    
    // CRUD routes
    Route::resource('users', UserController::class);  // This handles all CRUD routes for the User model
    Route::resource('categories', CategoriesController::class);
    Route::resource('posts', PostsController::class);
    Route::resource('members', MembersController::class);
    Route::resource('donations', DonationController::class);
    

});

require __DIR__.'/auth.php';
