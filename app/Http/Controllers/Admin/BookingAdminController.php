<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\NotificationLog;
use Illuminate\Http\Request;

class BookingAdminController extends Controller
{
    /**
     * List all bookings for admins (FR‑12).[file:1]
     */
    public function index()
    {
        $bookings = Booking::with('service')
            ->orderByDesc('date')
            ->orderByDesc('time')
            ->limit(200)
            ->get();

        return view('admin.bookings', compact('bookings'));
    }

    /**
     * Approve a pending booking (FR‑12).[file:1]
     */
    public function approve(Booking $booking)
    {
        if ($booking->status !== 'Pending') {
            return back()->with('status', 'Only pending bookings can be approved.');
        }

        $booking->status = 'Approved';
        $booking->save();

        NotificationLog::create([
            'booking_id' => $booking->id,
            'channel'    => 'SMS',
            'type'       => 'booking_approved',
            'recipient'  => $booking->customer_phone,
            'message'    => "Your booking #{$booking->id} has been approved.",
        ]);

        return back()->with('status', 'Booking approved.');
    }

    /**
     * Reject a booking (FR‑12).[file:1]
     */
    public function reject(Booking $booking)
    {
        if (!in_array($booking->status, ['Pending', 'Approved'])) {
            return back()->with('status', 'Only pending/approved bookings can be rejected.');
        }

        $booking->status = 'Rejected';
        $booking->save();

        NotificationLog::create([
            'booking_id' => $booking->id,
            'channel'    => 'SMS',
            'type'       => 'booking_rejected',
            'recipient'  => $booking->customer_phone,
            'message'    => "Your booking #{$booking->id} has been rejected.",
        ]);

        return back()->with('status', 'Booking rejected.');
    }

    /**
     * Mark a booking as completed and issue loyalty points (FR‑13, FR‑15).[file:1]
     */
    public function complete(Booking $booking)
    {
        if ($booking->status !== 'Approved') {
            return back()->with('status', 'Only approved bookings can be completed.');
        }

        $booking->status = 'Completed';

        // Simple loyalty scheme: 1 point per 100 BDT.[file:1]
        $points = (int) floor($booking->total_price / 100);
        $booking->loyalty_points = $points;
        $booking->save();

        NotificationLog::create([
            'booking_id' => $booking->id,
            'channel'    => 'SMS',
            'type'       => 'booking_completed',
            'recipient'  => $booking->customer_phone,
            'message'    => "Thank you! Booking #{$booking->id} completed. You earned {$points} loyalty points.",
        ]);

        return back()->with('status', 'Booking marked as completed.');
    }
}
