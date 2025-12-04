<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\StaffAdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ReportAdminController;
use App\Http\Controllers\Admin\NotificationAdminController;
use App\Models\Service;
use App\Models\Staff;
use App\Models\Customer;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
| Frontend and admin routes for the SSBP-RMS.[file:1]
*/

/**
 * Public / customer routes
 */

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

    // Demo “current customer” profile, used to prefill booking form later (FR‑1).[file:1]
    $customer = Customer::first();

    return view('public.booking', [
        'service'       => $service,
        'staffByBranch' => $staffByBranch,
        'customer'      => $customer,
    ]);
})->name('public.booking');

// POST: store new booking (FR‑3, FR‑4, FR‑5).[file:1]
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Booking history page (FR‑5, FR‑6).[file:1]
Route::get('/bookings', [BookingController::class, 'index'])->name('public.bookings');

// Cancel a booking from customer side (FR‑6).[file:1]
Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])
    ->name('public.bookings.cancel');

// Booking invoice / confirmation page (FR‑4, FR‑13).[file:1]
Route::get('/bookings/{booking}/invoice', [BookingController::class, 'invoice'])
    ->name('public.bookings.invoice');

// Profile: create/manage basic customer profile (FR‑1).[file:1]
Route::get('/profile', [ProfileController::class, 'edit'])->name('public.profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('public.profile.update');

// Feedback: show page + submit (FR‑7).[file:1]
Route::view('/feedback', 'public.feedback')->name('public.feedback');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('public.feedback.store');

/**
 * Admin routes
 */

Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    Route::get('/services', [ServiceAdminController::class, 'index'])->name('admin.services');

    Route::get('/staff', [StaffAdminController::class, 'index'])->name('admin.staff');

    Route::get('/bookings', [BookingAdminController::class, 'index'])->name('admin.bookings');
    Route::post('/bookings/{booking}/approve', [BookingAdminController::class, 'approve'])
        ->name('admin.bookings.approve');
    Route::post('/bookings/{booking}/reject', [BookingAdminController::class, 'reject'])
        ->name('admin.bookings.reject');
    Route::post('/bookings/{booking}/complete', [BookingAdminController::class, 'complete'])
        ->name('admin.bookings.complete');

    Route::get('/reports', [ReportAdminController::class, 'index'])->name('admin.reports');

    Route::view('/branches', 'admin.branches')->name('admin.branches');

    Route::get('/feedback', [FeedbackController::class, 'adminIndex'])
        ->name('admin.feedback');

    Route::get('/notifications', [NotificationAdminController::class, 'index'])
        ->name('admin.notifications');
});
