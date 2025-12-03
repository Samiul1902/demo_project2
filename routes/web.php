<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Models\Service;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Frontend and admin routes for the SSBP-RMS prototype.
| They implement the flows described in the SRS: browsing services,
| booking appointments, viewing history, and admin management.[file:1]
*/

/**
 * Public / customer routes
 */

// Home page
Route::view('/', 'public.home')->name('home');

// Services catalog & detail (FR‑2 + FR‑10: services managed in admin, shown to users).[file:1]
Route::get('/services', [ServiceController::class, 'index'])->name('public.services');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('public.service.detail');

// Booking flow
// GET: booking form, optional {service} pre-selects a service in the form (FR‑3).[file:1]
Route::get('/booking/{service?}', function (Service $service = null) {
    return view('public.booking', compact('service'));
})->name('public.booking');

// POST: store booking in DB via controller (FR‑3, FR‑4, FR‑5).[file:1]
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Booking history page using real bookings table (FR‑5, FR‑6).[file:1]
Route::get('/bookings', [BookingController::class, 'index'])->name('public.bookings');

// Profile & feedback (still UI-only for now)
Route::view('/profile', 'public.profile')->name('public.profile');
Route::view('/feedback', 'public.feedback')->name('public.feedback');


/**
 * Admin routes
 * Covers dashboard, service management, staff, bookings and reports (FR‑9–FR‑16).[file:1]
 */

Route::prefix('admin')->group(function () {
    // Dashboard
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');

    // Services management (DB-backed list)
    Route::get('/services', [ServiceAdminController::class, 'index'])->name('admin.services');

    // Bookings management (DB-backed list of all bookings)
    Route::get('/bookings', [BookingAdminController::class, 'index'])->name('admin.bookings');

    // Staff & schedules (UI wired earlier)
    Route::view('/staff', 'admin.staff')->name('admin.staff');

    // Reports & analytics
    Route::view('/reports', 'admin.reports')->name('admin.reports');

    // Branch management
    Route::view('/branches', 'admin.branches')->name('admin.branches');
});
