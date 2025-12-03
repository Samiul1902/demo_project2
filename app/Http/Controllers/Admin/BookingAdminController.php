<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;

class BookingAdminController extends Controller
{
    /**
     * Admin view of all bookings (FR‑9, FR‑12, FR‑13).[file:1]
     */
    public function index()
    {
        $bookings = Booking::with('service')
            ->orderByDesc('date')
            ->orderByDesc('time')
            ->get();

        return view('admin.bookings', compact('bookings'));
    }

    // Later you can add methods to approve/reject/update status.
}
