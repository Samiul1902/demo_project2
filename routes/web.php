<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\BookingController;
use App\Models\Service;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Frontend and admin routes for the SSBP-RMS prototype.
*/

/**
 * Public / customer routes
 * Covers FR‑1 to FR‑7 UI: profile, services, booking, history, feedback.[file:1]
 */

// Home page
Route::view('/', 'public.home')->name('home');

// Services catalog & detail (DB + controllers)
Route::get('/services', [ServiceController::class, 'index'])->name('public.services');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('public.service.detail');

// Booking flow (optional service pre-selected)
Route::get('/booking/{service?}', function (Service $service = null) {
    return view('public.booking', compact('service'));
})->name('public.booking');

// Profile & booking history
Route::view('/profile', 'public.profile')->name('public.profile');
Route::view('/bookings', 'public.bookings')->name('public.bookings');

// Feedback / reviews
Route::view('/feedback', 'public.feedback')->name('public.feedback');


/**
 * Admin routes
 * Covers FR‑9–FR‑16 UI: dashboard, services, staff, bookings, reports, branches.[file:1]
 */

Route::prefix('admin')->group(function () {
    // Dashboard
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');

    // Services management (controller uses DB)
    Route::get('/services', [ServiceAdminController::class, 'index'])->name('admin.services');

    // Staff & schedules
    Route::view('/staff', 'admin.staff')->name('admin.staff');

    // Booking approval/rejection
    Route::view('/bookings', 'admin.bookings')->name('admin.bookings');

    // Reports & analytics
    Route::view('/reports', 'admin.reports')->name('admin.reports');

    // Branch management
    Route::view('/branches', 'admin.branches')->name('admin.branches');
});


// Booking form (GET is already defined); add POST to store booking
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');