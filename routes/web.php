<?php

use Illuminate\Support\Facades\Route;

// Public controllers
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\FeedbackController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RecommendationController;
use App\Http\Controllers\PaymentController;

// Admin controllers
use App\Http\Controllers\Admin\ServiceAdminController;
use App\Http\Controllers\Admin\BookingAdminController;
use App\Http\Controllers\Admin\StaffAdminController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\ReportAdminController;
use App\Http\Controllers\Admin\NotificationAdminController;
use App\Http\Controllers\Admin\BranchAdminController;

// Models used in route closures
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

// Home page
Route::view('/', 'public.home')->name('home');

// Services catalog & detail (FR‑2, FR‑10).[file:1]
Route::get('/services', [ServiceController::class, 'index'])->name('public.services');
Route::get('/services/{service}', [ServiceController::class, 'show'])->name('public.service.detail');

// Booking form with optional pre-selected service and profile prefill (FR‑1, FR‑3).[file:1]
Route::get('/booking/{service?}', function (Service $service = null) {
    $staffByBranch = Staff::where('status', 'Active')
        ->orderBy('branch')
        ->orderBy('name')
        ->get()
        ->groupBy('branch');

    $customer = Customer::first();

    return view('public.booking', [
        'service'       => $service,
        'staffByBranch' => $staffByBranch,
        'customer'      => $customer,
    ]);
})->name('public.booking');

// Store booking (FR‑3, FR‑4, FR‑5).[file:1]
Route::post('/booking', [BookingController::class, 'store'])->name('booking.store');

// Booking history & cancellation (FR‑5, FR‑6).[file:1]
Route::get('/bookings', [BookingController::class, 'index'])->name('public.bookings');
Route::post('/bookings/{booking}/cancel', [BookingController::class, 'cancel'])
    ->name('public.bookings.cancel');

// Booking invoice / confirmation (FR‑4, FR‑13).[file:1]
Route::get('/bookings/{booking}/invoice', [BookingController::class, 'invoice'])
    ->name('public.bookings.invoice');

// Profile management (FR‑1).[file:1]
Route::get('/profile', [ProfileController::class, 'edit'])->name('public.profile');
Route::post('/profile', [ProfileController::class, 'update'])->name('public.profile.update');

// Feedback form + submission (FR‑7).[file:1]
Route::view('/feedback', 'public.feedback')->name('public.feedback');
Route::post('/feedback', [FeedbackController::class, 'store'])->name('public.feedback.store');

// Simple AI-style recommendations page (FR‑17 prototype).[file:1]
Route::get('/recommendations', [RecommendationController::class, 'index'])
    ->name('public.recommendations');

// Chatbot demo page (FR‑18 prototype).[file:1]
Route::view('/chatbot', 'public.chatbot')->name('public.chatbot');

// SSLCommerz payment integration (FR‑22)
// Start payment for a booking.
Route::post('/payment/sslcommerz/start/{booking}', [PaymentController::class, 'start'])
    ->name('payment.sslcommerz.start');

// Callback URLs configured in SSLCommerz dashboard.[web:15]
Route::post('/payment/sslcommerz/success', [PaymentController::class, 'success'])
    ->name('payment.sslcommerz.success');
Route::post('/payment/sslcommerz/fail', [PaymentController::class, 'fail'])
    ->name('payment.sslcommerz.fail');
Route::post('/payment/sslcommerz/cancel', [PaymentController::class, 'cancel'])
    ->name('payment.sslcommerz.cancel');


/**
 * Admin routes
 */

Route::prefix('admin')->group(function () {
    // Dashboard with KPIs (FR‑9).[file:1]
    Route::get('/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');

    // Services management (FR‑10).[file:1]
    Route::get('/services', [ServiceAdminController::class, 'index'])->name('admin.services');

    // Staff management + schedule editing (FR‑11).[file:1]
    Route::get('/staff', [StaffAdminController::class, 'index'])->name('admin.staff');
    Route::post('/staff/{staff}/schedule', [StaffAdminController::class, 'updateSchedule'])
        ->name('admin.staff.schedule');

    // Bookings management, approval, completion (FR‑12, FR‑13).[file:1]
    Route::get('/bookings', [BookingAdminController::class, 'index'])->name('admin.bookings');
    Route::post('/bookings/{booking}/approve', [BookingAdminController::class, 'approve'])
        ->name('admin.bookings.approve');
    Route::post('/bookings/{booking}/reject', [BookingAdminController::class, 'reject'])
        ->name('admin.bookings.reject');
    Route::post('/bookings/{booking}/complete', [BookingAdminController::class, 'complete'])
        ->name('admin.bookings.complete');

    // Reports & analytics, including loyalty points (FR‑14, FR‑15).[file:1]
    Route::get('/reports', [ReportAdminController::class, 'index'])->name('admin.reports');

    // Branch management (FR‑16 multi-branch).[file:1]
    Route::get('/branches', [BranchAdminController::class, 'index'])->name('admin.branches');
    Route::post('/branches', [BranchAdminController::class, 'store'])->name('admin.branches.store');
    Route::post('/branches/{branch}', [BranchAdminController::class, 'update'])->name('admin.branches.update');

    // Feedback list for admins (FR‑7 admin-side).[file:1]
    Route::get('/feedback', [FeedbackController::class, 'adminIndex'])
        ->name('admin.feedback');

    // Notification log for booking events and reminders (FR‑8, FR‑19).[file:1]
    Route::get('/notifications', [NotificationAdminController::class, 'index'])
        ->name('admin.notifications');
});
