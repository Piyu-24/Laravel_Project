<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\BookingController;
use Illuminate\Support\Facades\Route;

// Route for the home page (e.g., welcome page)
// Display the welcome page for visitors who are not authenticated
Route::get('/', function () {
    return view('welcome');
});

// Route for the dashboard: authenticated users will see available vehicles and the booking form
// This will show the vehicles available for booking (whether they search or not)
Route::get('/dashboard', [VehicleController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

// Protect profile routes with authentication middleware
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Route for searching vehicles
// This will use the search method in VehicleController and return filtered results to the dashboard
Route::get('/search', [VehicleController::class, 'search'])->name('search');


// Route for booking a vehicle
// The 'store' method in BookingController will handle the booking process
Route::post('/book', [BookingController::class, 'store'])
    ->middleware(['auth', 'verified'])
    ->name('book.store');

Route::get('/book/{vehicle}', [BookingController::class, 'create'])->name('book.create');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [BookingController::class, 'showBookedVehicles'])->name('dashboard');
    Route::delete('/bookings/{booking}', [BookingController::class, 'cancelBooking'])->name('bookings.cancelBooking');
});

Route::middleware(['auth', 'role:Admin'])->group(function () {
    Route::get('/admin', function () {
        return 'Admin Dashboard';
    });
});

Route::middleware(['auth', 'role:Customer'])->group(function () {
    Route::get('/customer', function () {
        return 'Customer Dashboard';
    });
});

// Authentication routes (Laravel's default authentication system)
require __DIR__.'/auth.php';
