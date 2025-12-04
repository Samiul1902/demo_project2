<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Reports &amp; analytics
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                Revenue, booking trends, and loyalty points to help salon owners track performance
                across branches as required by FR‑14 and the loyalty program in FR‑15.[file:1]
            </p>

            {{-- Top summary cards --}}
            <div class="row" style="gap:1rem; margin-bottom:1.2rem;">
                <div class="card" style="flex:1 1 0; padding:0.9rem;">
                    <div style="font-size:0.8rem; color:#9ca3af;">Total revenue</div>
                    <div style="font-size:1.3rem; font-weight:700; color:#fb7185;">
                        BDT {{ number_format($totalRevenue, 2) }}
                    </div>
                </div>
                <div class="card" style="flex:1 1 0; padding:0.9rem;">
                    <div style="font-size:0.8rem; color:#9ca3af;">Total bookings</div>
                    <div style="font-size:1.3rem; font-weight:700; color:#e5e7eb;">
                        {{ $totalBookings }}
                    </div>
                </div>
                <div class="card" style="flex:1 1 0; padding:0.9rem;">
                    <div style="font-size:0.8rem; color:#9ca3af;">Loyalty points (all time)</div>
                    <div style="font-size:1.3rem; font-weight:700; color:#4ade80;">
                        {{ $totalLoyaltyPoints }}
                    </div>
                    <div style="font-size:0.8rem; color:#9ca3af; margin-top:0.2rem;">
                        This month: <span style="color:#22c55e;">{{ $monthlyLoyaltyPoints }}</span>
                    </div>
                </div>
            </div>

            {{-- Booking status breakdown --}}
            <div class="card" style="margin-bottom:1.2rem;">
                <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.6rem;">
                    Booking status overview
                </h2>
                <div style="display:flex; flex-wrap:wrap; gap:0.9rem; font-size:0.9rem;">
                    <div>Pending: <span style="color:#facc15;">{{ $pendingCount }}</span></div>
                    <div>Approved: <span style="color:#4ade80;">{{ $approvedCount }}</span></div>
                    <div>Completed: <span style="color:#60a5fa;">{{ $completedCount }}</span></div>
                    <div>Cancelled: <span style="color:#9ca3af;">{{ $cancelledCount }}</span></div>
                </div>
            </div>

            {{-- Revenue by branch --}}
            <div class="card" style="margin-bottom:1.2rem; overflow-x:auto;">
                <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.6rem;">
                    Revenue by branch
                </h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Branch</th>
                            <th>Completed bookings</th>
                            <th style="text-align:right;">Revenue (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($revenueByBranch as $row)
                            <tr>
                                <td>{{ $row->branch }}</td>
                                <td>{{ $row->count }}</td>
                                <td style="text-align:right;">
                                    {{ number_format($row->revenue, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="font-size:0.85rem; color:#9ca3af; text-align:center;">
                                    No completed bookings yet. Revenue by branch will appear here once
                                    services are completed and invoiced.[file:1]
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Last 7 days summary --}}
            <div class="card" style="overflow-x:auto;">
                <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.6rem;">
                    Last 7 days (revenue &amp; bookings)
                </h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Bookings</th>
                            <th style="text-align:right;">Revenue (BDT)</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($dailyRevenue as $row)
                            <tr>
                                <td>{{ \Carbon\Carbon::parse($row->date)->format('d M Y') }}</td>
                                <td>{{ $row->count }}</td>
                                <td style="text-align:right;">
                                    {{ number_format($row->revenue, 2) }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="3" style="font-size:0.85rem; color:#9ca3af; text-align:center;">
                                    No revenue recorded in the last 7 days yet.[file:1]
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
