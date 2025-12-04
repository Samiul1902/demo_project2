<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Service;
use Illuminate\Http\Request;
use Carbon\Carbon;

class BookingController extends Controller
{
    /**
     * Show customer booking history (FR‑5).[file:1]
     */
    public function index()
    {
        // For now this shows all bookings; later you can filter by authenticated user.
        $bookings = Booking::with('service')
            ->orderByDesc('date')
            ->orderByDesc('time')
            ->get();

        return view('public.bookings', compact('bookings'));
    }

    /**
     * Store a new booking created from the public form (FR‑3, FR‑4).[file:1]
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'customer_name'      => ['required', 'string', 'max:255'],
            'customer_phone'     => ['nullable', 'string', 'max:50'],
            'service_id'         => ['required', 'exists:services,id'],
            'branch'             => ['required', 'string', 'max:255'],
            'stylist_preference' => ['nullable', 'string', 'max:255'],
            'date'               => ['required', 'date'],
            'time'               => ['required', 'string', 'max:50'],
            'notes'              => ['nullable', 'string', 'max:1000'],
        ]);

        $service = Service::findOrFail($data['service_id']);

        $booking = Booking::create([
            'customer_name'      => $data['customer_name'],
            'customer_phone'     => $data['customer_phone'] ?? null,
            'service_id'         => $service->id,
            'branch'             => $data['branch'],
            'stylist_preference' => $data['stylist_preference'] ?? null,
            'date'               => $data['date'],
            'time'               => $data['time'],
            'notes'              => $data['notes'] ?? null,
            'status'             => 'Pending',          // Initial status; admin can approve/reject (FR‑12).[file:1]
            'total_price'        => $service->price,    // Used on invoice and reports (FR‑4, FR‑13, FR‑14).[file:1]
        ]);

        // Later: trigger SMS/Email notification here (FR‑8).[file:1]

        // After creating, go straight to confirmation/invoice page (FR‑4).[file:1]
        return redirect()->route('public.bookings.invoice', $booking);
    }

    /**
     * Show a digital invoice / confirmation for a single booking (FR‑4, FR‑13).[file:1]
     */
    public function invoice(Booking $booking)
    {
        $booking->load('service');

        return view('public.invoice', compact('booking'));
    }

    /**
     * Allow a customer to cancel an upcoming booking (FR‑6).[file:1]
     */
    public function cancel(Booking $booking, Request $request)
    {
        // Simple rule: only pending or approved bookings that are still in the future
        // can be cancelled. You can later enforce a 24‑hour window as per OR‑10.[file:1]
        $bookingDateTime = Carbon::parse($booking->date . ' ' . $booking->time);

        if (in_array($booking->status, ['Pending', 'Approved']) &&
            $bookingDateTime->isFuture()) {

            $booking->status = 'Cancelled';
            $booking->save();

            return redirect()
                ->route('public.bookings')
                ->with('status', 'Your booking #'.$booking->id.' has been cancelled.');
        }

        return redirect()
            ->route('public.bookings')
            ->with('status', 'This booking can no longer be cancelled.');
    }
}
