<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\SocialiteController;
use App\Http\Controllers\ProfileController;

// Homepage Route
Route::get('/', [HotelController::class, 'index'])->name('home');

// Hotel Routes
Route::get('/hotels', [HotelController::class, 'list'])->name('hotels.list');
Route::get('/hotels/search', [HotelController::class, 'search'])->name('hotels.search');
Route::get('/hotels/{hotel}', [HotelController::class, 'show'])->name('hotels.show');

// Socialite Google Authentication Routes
Route::controller(SocialiteController::class)->group(function () {
    Route::get('auth/google', 'googleLogin')->name('auth.google');
    Route::get('auth/google-callback', 'googleAuthentication')->name('auth.google.callback');
});

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// User Profile Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
});

// Hotel Bookings and Favorites Routes
Route::middleware(['auth'])->group(function () {
    Route::get('/my-bookings', [HotelController::class, 'myBookings'])->name('hotels.mybookings');
    Route::get('/favorites', [HotelController::class, 'favorites'])->name('hotels.favorites');
    Route::post('/hotels/{hotel}/favorite', [HotelController::class, 'toggleFavorite'])->name('hotels.toggleFavorite');
});
