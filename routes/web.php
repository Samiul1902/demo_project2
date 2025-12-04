<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\StaffAdminController;
use App\Models\Service;
use App\Models\Staff;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Frontend and admin routes for the SSBP-RMS.
| They cover browsing services, booking appointments, viewing history,
| and admin management of services, staff, and bookings as per the SRS.[file:1]
*/

/**
 * Public / customer routes
 */

// Home page
Route::view('/', 'public.home')->name('home');

// Services catalog & detail (FR‑2, FR‑10).[file:1]
Route::get('/services', [ServiceController::class, 'index'])->name('public.services');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('public.service.detail');

// Booking flow
// GET: booking form; optional {service} pre-selects a service (FR‑3).[file:1]
Route::get('/booking/{service?}', function (Service $service = null) {
    $staffByBranch = Staff::where('status', 'Active')
        ->orderBy('branch')
        ->orderBy('name')
        ->get()
        ->groupBy('branch');

    return view('public.booking', [
        'service'       => $service,
        'staffByBranch' => $staffByBranch,
    ]);
})->name('public.booking');

// POST: store new booking (FR‑3, FR‑4, FR‑5).[file:1]
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Booking history page (FR‑5, FR‑6).[file:1]
Route::get('/bookings', [BookingController::class, 'index'])->name('public.bookings');

// Profile & feedback (UI prototypes for FR‑1, FR‑7).[file:1]
Route::view('/profile', 'public.profile')->name('public.profile');
Route::view('/feedback', 'public.feedback')->name('public.feedback');

/**
 * Admin routes
 * Dashboard, services, staff, bookings, reports, branches (FR‑9–FR‑16).[file:1]
 */

Route::prefix('admin')->group(function () {
    // Dashboard
    Route::view('/dashboard', 'admin.dashboard')->name('admin.dashboard');

    // Services management (DB-backed)
    Route::get('/services', [ServiceAdminController::class, 'index'])->name('admin.services');

    // Staff management (DB-backed, prepares for schedules FR‑11).[file:1]
    Route::get('/staff', [StaffAdminController::class, 'index'])->name('admin.staff');

    // Bookings management (view all bookings, FR‑12/FR‑13).[file:1]
    Route::get('/bookings', [BookingAdminController::class, 'index'])->name('admin.bookings');

    // Booking approval / status changes (FR‑12, FR‑13).[file:1]
    Route::post('/bookings/{booking}/approve', [BookingAdminController::class, 'approve'])
        ->name('admin.bookings.approve');
    Route::post('/bookings/{booking}/reject', [BookingAdminController::class, 'reject'])
        ->name('admin.bookings.reject');
    Route::post('/bookings/{booking}/complete', [BookingAdminController::class, 'complete'])
        ->name('admin.bookings.complete');

    // Reports & analytics
    Route::view('/reports', 'admin.reports')->name('admin.reports');

    // Branch management (multi-branch FR‑16).[file:1]
    Route::view('/branches', 'admin.branches')->name('admin.branches');
});

// Cancel a booking from customer side (FR‑6).[file:1]
Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])
    ->name('public.bookings.cancel');

// Booking invoice / confirmation page (FR‑4, FR‑13).[file:1]
Route::get('/bookings/{booking}/invoice', [BookingController::class, 'invoice'])
    ->name('public.bookings.invoice');
