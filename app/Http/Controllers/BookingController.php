<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;

class BookingController extends Controller
{
    /**
     * Store a new booking (FR‑3) as Pending.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'service_id'         => ['required', 'exists:services,id'],
            'customer_name'      => ['required', 'string', 'max:255'],
            'customer_phone'     => ['nullable', 'string', 'max:50'],
            'branch'             => ['required', 'string', 'max:255'],
            'date'               => ['required', 'date'],
            'time'               => ['required', 'string', 'max:20'],
            'stylist_preference' => ['nullable', 'string', 'max:255'],
            'notes'              => ['nullable', 'string'],
        ]);

        $booking = Booking::create($data + ['status' => 'Pending']);

        // Later: trigger SMS/Email notification (FR‑8) and invoice generation (FR‑4).[file:1]

        return redirect()
            ->route('public.bookings')
            ->with('status', 'Booking created with ID ' . $booking->id . ' and waiting for approval.');
    }
}
