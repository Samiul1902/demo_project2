<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up" style="max-width:720px; margin:0 auto;">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Booking confirmation
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                This is your digital invoice for the appointment, fulfilling the confirmation
                and invoicing requirements (FR‑4, FR‑13) and showing loyalty points earned
                as part of FR‑15/FR‑20.[file:1]
            </p>

            @if(session('status'))
                <div class="card"
                     style="margin-bottom:1rem; font-size:0.85rem; color:#bbf7d0; border-color:rgba(34,197,94,0.4);">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card" style="margin-bottom:1.2rem;">
                @php
                    $dt = \Carbon\Carbon::parse($booking->date.' '.$booking->time);
                @endphp

                <div style="display:flex; justify-content:space-between; margin-bottom:0.6rem; font-size:0.9rem;">
                    <div>
                        <div style="color:#9ca3af; font-size:0.8rem;">Invoice #</div>
                        <div style="color:#e5e7eb; font-weight:600;">SSBP‑{{ $booking->id }}</div>
                    </div>
                    <div style="text-align:right;">
                        <div style="color:#9ca3af; font-size:0.8rem;">Date</div>
                        <div style="color:#e5e7eb;">{{ $dt->format('d M Y') }}</div>
                    </div>
                </div>

                <hr style="border-color:rgba(148,163,184,0.25); margin:0.7rem 0;">

                <div style="display:flex; justify-content:space-between; gap:1.5rem; margin-bottom:0.8rem; font-size:0.9rem;">
                    <div style="flex:1 1 0;">
                        <div style="color:#9ca3af; font-size:0.8rem;">Billed to</div>
                        <div style="color:#e5e7eb; font-weight:600;">{{ $booking->customer_name }}</div>
                        @if($booking->customer_phone)
                            <div style="color:#9ca3af; font-size:0.8rem;">{{ $booking->customer_phone }}</div>
                        @endif
                    </div>
                    <div style="flex:1 1 0; text-align:right;">
                        <div style="color:#9ca3af; font-size:0.8rem;">Branch</div>
                        <div style="color:#e5e7eb; font-weight:600;">{{ $booking->branch }}</div>
                        <div style="color:#9ca3af; font-size:0.8rem;">Time: {{ $dt->format('h:i A') }}</div>
                    </div>
                </div>

                <table style="width:100%; border-collapse:collapse; margin-top:0.5rem; font-size:0.9rem;">
                    <thead>
                        <tr style="color:#9ca3af; text-align:left; font-size:0.8rem;">
                            <th style="padding:0.4rem 0;">Service</th>
                            <th style="padding:0.4rem 0;">Duration</th>
                            <th style="padding:0.4rem 0; text-align:right;">Price (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td style="padding:0.4rem 0; color:#e5e7eb;">
                                {{ $booking->service?->name ?? 'Service removed' }}
                            </td>
                            <td style="padding:0.4rem 0; color:#9ca3af;">
                                {{ $booking->service?->duration }} min
                            </td>
                            <td style="padding:0.4rem 0; color:#e5e7eb; text-align:right;">
                                {{ number_format($booking->total_price, 2) }}
                            </td>
                        </tr>
                    </tbody>
                </table>

                <hr style="border-color:rgba(148,163,184,0.25); margin:0.7rem 0;">

                <div style="display:flex; justify-content:space-between; font-size:0.9rem;">
                    <span style="color:#9ca3af;">Subtotal</span>
                    <span style="color:#e5e7eb;">BDT {{ number_format($booking->total_price, 2) }}</span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:0.9rem; margin-top:0.15rem;">
                    <span style="color:#9ca3af;">Discount / loyalty redeemed</span>
                    <span style="color:#22c55e;">BDT 0.00</span>
                </div>
                <div style="display:flex; justify-content:space-between; font-size:1rem; font-weight:700; margin-top:0.4rem;">
                    <span>Total</span>
                    <span style="color:#fb7185;">BDT {{ number_format($booking->total_price, 2) }}</span>
                </div>

                <div style="margin-top:0.7rem; padding:0.6rem 0.7rem; border-radius:0.75rem; background:#020617; border:1px dashed rgba(74,222,128,0.5);">
                    <div style="font-size:0.85rem; color:#4ade80; font-weight:600;">
                        Loyalty points earned: {{ $booking->loyalty_points }}
                    </div>
                    <div style="font-size:0.78rem; color:#9ca3af; margin-top:0.2rem;">
                        Points are calculated from the service price and can be used later in the
                        membership program described in FR‑15 and FR‑20.[file:1]
                    </div>
                </div>

                <p style="font-size:0.8rem; color:#9ca3af; margin-top:0.7rem;">
                    Status: <span style="color:#e5e7eb; font-weight:600;">{{ $booking->status }}</span>.
                    Once the service is marked as completed by the salon, this invoice will be
                    included in admin revenue and performance reports.[file:1]
                </p>
            </div>

            {{-- Actions: back, print, and pay online --}}
            <div style="display:flex; justify-content:space-between; gap:0.7rem; align-items:center;">
                <a href="{{ route('public.bookings') }}"
                   class="btn glow-btn"
                   style="background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;">
                    Back to my bookings
                </a>

                <div style="display:flex; gap:0.5rem; margin-left:auto;">
                    {{-- Print button --}}
                    <button type="button"
                            class="btn glow-btn"
                            style="background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                            onclick="window.print()">
                        Print / Save as PDF
                    </button>

                    {{-- SSLCommerz payment button (FR‑22) --}}
                    <form action="{{ route('payment.sslcommerz.start', $booking) }}"
                          method="POST">
                        @csrf
                        <button type="submit"
                                class="btn btn-pink glow-btn">
                            Pay online (SSLCommerz)
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
