<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Str;

class PaymentController extends Controller
{
    /**
     * Initiate SSLCommerz payment for a booking (FR‑22).[web:15]
     */
    public function start(Booking $booking)
    {
        // Create local payment record first
        $tranId = 'SSBP_' . $booking->id . '_' . Str::random(8);

        $payment = Payment::create([
            'booking_id' => $booking->id,
            'store_id'   => config('services.sslcommerz.store_id'),
            'tran_id'    => $tranId,
            'currency'   => 'BDT',
            'amount'     => $booking->total_price,
            'status'     => 'INITIATED',
        ]);

        // Build payload for SSLCommerz hosted checkout (simplified).[web:15][web:25]
        $payload = [
            'store_id'     => config('services.sslcommerz.store_id'),
            'store_passwd' => config('services.sslcommerz.store_password'),
            'total_amount' => $payment->amount,
            'currency'     => $payment->currency,
            'tran_id'      => $payment->tran_id,
            'success_url'  => config('services.sslcommerz.success_url'),
            'fail_url'     => config('services.sslcommerz.fail_url'),
            'cancel_url'   => config('services.sslcommerz.cancel_url'),

            // Customer info
            'cus_name'     => $booking->customer_name,
            'cus_email'    => 'customer@example.com',
            'cus_add1'     => $booking->branch,
            'cus_city'     => 'Dhaka',
            'cus_country'  => 'Bangladesh',
            'cus_phone'    => $booking->customer_phone ?? '01700000000',

            // Product info (single-service booking)
            'product_name'     => $booking->service?->name ?? 'Salon service',
            'product_category' => 'Salon Service',
            'product_profile'  => 'general',
        ];

        $endpoint = config('services.sslcommerz.sandbox')
            ? 'https://sandbox.sslcommerz.com/gwprocess/v4/api.php'
            : 'https://securepay.sslcommerz.com/gwprocess/v4/api.php';

        $response = Http::asForm()->post($endpoint, $payload);

        $payment->gateway_payload = $response->json();
        $payment->save();

        if (!$response->ok() || ($response['status'] ?? '') !== 'SUCCESS') {
            return redirect()
                ->route('public.bookings.invoice', $booking)
                ->with('status', 'Could not initiate payment. Please try again or pay at salon.');
        }

        // SSLCommerz returns GatewayPageURL for redirect.[web:15]
        return redirect()->away($response['GatewayPageURL']);
    }

    /**
     * SSLCommerz success callback (POST).[web:15]
     */
    public function success(Request $request)
    {
        $tranId = $request->input('tran_id');
        $payment = Payment::where('tran_id', $tranId)->firstOrFail();
        $booking = $payment->booking;

        $payment->status = 'SUCCESS';
        $payment->gateway_payload = array_merge($payment->gateway_payload ?? [], [
            'success_callback' => $request->all(),
        ]);
        $payment->save();

        // Mark booking as Approved (still completed by admin later).
        if ($booking->status === 'Pending') {
            $booking->status = 'Approved';
            $booking->save();
        }

        return redirect()
            ->route('public.bookings.invoice', $booking)
            ->with('status', 'Payment successful. Your booking is confirmed.');
    }

    /**
     * SSLCommerz fail callback (POST).[web:15]
     */
    public function fail(Request $request)
    {
        $tranId = $request->input('tran_id');
        $payment = Payment::where('tran_id', $tranId)->first();

        if ($payment) {
            $payment->status = 'FAILED';
            $payment->gateway_payload = array_merge($payment->gateway_payload ?? [], [
                'fail_callback' => $request->all(),
            ]);
            $payment->save();
        }

        $booking = $payment?->booking;

        return $booking
            ? redirect()->route('public.bookings.invoice', $booking)
                ->with('status', 'Payment failed. You can try again or pay at salon.')
            : redirect()->route('home');
    }

    /**
     * SSLCommerz cancel callback (POST).[web:15]
     */
    public function cancel(Request $request)
    {
        $tranId = $request->input('tran_id');
        $payment = Payment::where('tran_id', $tranId)->first();

        if ($payment) {
            $payment->status = 'CANCELLED';
            $payment->gateway_payload = array_merge($payment->gateway_payload ?? [], [
                'cancel_callback' => $request->all(),
            ]);
            $payment->save();
        }

        $booking = $payment?->booking;

        return $booking
            ? redirect()->route('public.bookings.invoice', $booking)
                ->with('status', 'Payment was cancelled. Your booking remains pending.')
            : redirect()->route('home');
    }
}
