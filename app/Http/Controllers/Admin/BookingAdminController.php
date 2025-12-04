<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\NotificationLog;
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

            // Log approval notification (FR‑8).[file:1]
            NotificationLog::create([
                'booking_id' => $booking->id,
                'channel'    => 'SMS',
                'type'       => 'booking_approved',
                'recipient'  => $booking->customer_phone,
                'message'    => "Your booking #{$booking->id} on {$booking->date} at {$booking->time} has been approved.",
            ]);
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

            // Log rejection notification (FR‑8).[file:1]
            NotificationLog::create([
                'booking_id' => $booking->id,
                'channel'    => 'SMS',
                'type'       => 'booking_rejected',
                'recipient'  => $booking->customer_phone,
                'message'    => "Your booking #{$booking->id} on {$booking->date} at {$booking->time} could not be accepted. Please contact the salon.",
            ]);
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

            // Log completion notification (FR‑8).[file:1]
            NotificationLog::create([
                'booking_id' => $booking->id,
                'channel'    => 'SMS',
                'type'       => 'booking_completed',
                'recipient'  => $booking->customer_phone,
                'message'    => "Thank you for visiting. Your booking #{$booking->id} has been completed.",
            ]);
        }

        return redirect()
            ->route('admin.bookings')
            ->with('status', 'Booking #'.$booking->id.' marked as completed.');
    }
}
