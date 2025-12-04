<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Http\Request;

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

    /**
     * Approve a pending booking (FR‑12).[file:1]
     */
    public function approve(Booking $booking, Request $request)
    {
        if ($booking->status === 'Pending') {
            $booking->status = 'Approved';
            $booking->save();
        }

        return redirect()
            ->route('admin.bookings')
            ->with('status', 'Booking #'.$booking->id.' approved.');
    }

    /**
     * Reject a pending booking (FR‑12).[file:1]
     */
    public function reject(Booking $booking, Request $request)
    {
        if ($booking->status === 'Pending') {
            $booking->status = 'Rejected';
            $booking->save();
        }

        return redirect()
            ->route('admin.bookings')
            ->with('status', 'Booking #'.$booking->id.' rejected.');
    }

    /**
     * Mark a booking as completed so it can be invoiced (FR‑13).[file:1]
     */
    public function complete(Booking $booking, Request $request)
    {
        if (in_array($booking->status, ['Approved', 'Pending'])) {
            $booking->status = 'Completed';
            $booking->save();
        }

        return redirect()
            ->route('admin.bookings')
            ->with('status', 'Booking #'.$booking->id.' marked as completed.');
    }
}
