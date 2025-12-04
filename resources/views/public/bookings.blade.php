<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                My bookings
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                View upcoming and past salon appointments, manage cancellations, and
                access invoices as required by FR‑5 and FR‑6.[file:1]
            </p>

            @if(session('status'))
                <div class="card"
                     style="margin-bottom:1rem; font-size:0.85rem; color:#bbf7d0; border-color:rgba(34,197,94,0.4);">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card" style="overflow-x:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service</th>
                            <th>Branch</th>
                            <th>Date &amp; time</th>
                            <th>Status</th>
                            <th>Total (BDT)</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $booking)
                            <tr>
                                <td>#{{ $booking->id }}</td>
                                <td>{{ $booking->service?->name ?? 'Service' }}</td>
                                <td>{{ $booking->branch }}</td>
                                <td>
                                    {{ $booking->date?->format('d M Y') ?? $booking->date }}
                                    • {{ $booking->time }}
                                </td>
                                <td>
                                    <span class="badge badge-{{ strtolower($booking->status) }}">
                                        {{ $booking->status }}
                                    </span>
                                </td>
                                <td>{{ number_format($booking->total_price, 2) }}</td>
                                <td style="text-align:right;">
                                    <a href="{{ route('public.bookings.invoice', $booking) }}"
                                       class="btn btn-ghost"
                                       style="font-size:0.8rem; padding:0.25rem 0.6rem;">
                                        Invoice
                                    </a>

                                    @if(in_array($booking->status, ['Pending', 'Approved']))
                                        <form method="POST"
                                              action="{{ route('public.bookings.cancel', $booking) }}"
                                              style="display:inline;">
                                            @csrf
                                            <button type="submit"
                                                    class="btn btn-outline"
                                                    style="font-size:0.8rem; padding:0.25rem 0.6rem; margin-left:0.3rem;">
                                                Cancel
                                            </button>
                                        </form>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7"
                                    style="font-size:0.85rem; color:#9ca3af; text-align:center;">
                                    You have no bookings yet. Use the Book page to create your
                                    first appointment and test FR‑3, FR‑4, and FR‑5.[file:1]
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
