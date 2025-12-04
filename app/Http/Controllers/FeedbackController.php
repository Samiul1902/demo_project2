<?php

namespace App\Http\Controllers;

use App\Models\Feedback;
use App\Models\Booking;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Store feedback submitted by a customer (FR‑7).[file:1]
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'booking_id'     => ['nullable', 'exists:bookings,id'],
            'customer_name'  => ['required', 'string', 'max:255'],
            'customer_phone' => ['nullable', 'string', 'max:50'],
            'rating'         => ['nullable', 'integer', 'min:1', 'max:5'],
            'comments'       => ['nullable', 'string', 'max:2000'],
            'target_type'    => ['nullable', 'string', 'max:50'],
            'target_name'    => ['nullable', 'string', 'max:255'],
        ]);

        Feedback::create([
            'booking_id'     => $data['booking_id'] ?? null,
            'customer_name'  => $data['customer_name'],
            'customer_phone' => $data['customer_phone'] ?? null,
            'rating'         => $data['rating'] ?? null,
            'comments'       => $data['comments'] ?? null,
            'target_type'    => $data['target_type'] ?? 'overall',
            'target_name'    => $data['target_name'] ?? null,
        ]);

        return redirect()
            ->route('public.feedback')
            ->with('status', 'Thank you for sharing your feedback.');
    }

    /**
     * Simple admin list of feedback items (FR‑7, admin side).[file:1]
     */
    public function adminIndex()
    {
        $feedback = Feedback::with('booking')
            ->orderByDesc('created_at')
            ->paginate(10);

        return view('admin.feedback', compact('feedback'));
    }
}
