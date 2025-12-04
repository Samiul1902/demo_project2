<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.7rem; font-weight:800; margin-bottom:0.4rem;">
                Admin dashboard
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                High-level snapshot of today&apos;s activity, revenue, and key resources, as required
                by the admin dashboard feature (FR‑9).[file:1]
            </p>

            {{-- Top KPI cards --}}
            <div class="row" style="gap:1rem; margin-bottom:1.2rem;">
                <div class="card" style="flex:1 1 0; padding:0.9rem;">
                    <div style="font-size:0.8rem; color:#9ca3af;">Today&apos;s bookings</div>
                    <div style="font-size:1.4rem; font-weight:700; color:#e5e7eb;">
                        {{ $todayBookings }}
                    </div>
                    <div style="font-size:0.8rem; color:#9ca3af; margin-top:0.2rem;">
                        Total bookings: <span style="color:#fb7185;">{{ $totalBookings }}</span>
                    </div>
                </div>

                <div class="card" style="flex:1 1 0; padding:0.9rem;">
                    <div style="font-size:0.8rem; color:#9ca3af;">Today&apos;s revenue</div>
                    <div style="font-size:1.4rem; font-weight:700; color:#fb7185;">
                        BDT {{ number_format($todayRevenue, 2) }}
                    </div>
                    <div style="font-size:0.8rem; color:#9ca3af; margin-top:0.2rem;">
                        Total revenue: <span style="color:#4ade80;">BDT {{ number_format($totalRevenue, 2) }}</span>
                    </div>
                </div>

                <div class="card" style="flex:1 1 0; padding:0.9rem;">
                    <div style="font-size:0.8rem; color:#9ca3af;">Resources</div>
                    <div style="font-size:1.4rem; font-weight:700; color:#e5e7eb;">
                        {{ $serviceCount }} services
                    </div>
                    <div style="font-size:0.8rem; color:#9ca3af; margin-top:0.2rem;">
                        Staff members: <span style="color:#60a5fa;">{{ $staffCount }}</span>
                    </div>
                </div>
            </div>

            {{-- Booking status overview + quick links --}}
            <div class="row" style="gap:1rem; margin-bottom:1.2rem;">
                <div class="card" style="flex:2 1 0; padding:0.9rem;">
                    <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.5rem;">
                        Booking status overview
                    </h2>
                    <div style="display:flex; flex-wrap:wrap; gap:0.9rem; font-size:0.9rem;">
                        <div>Pending: <span style="color:#facc15; font-weight:600;">{{ $pendingCount }}</span></div>
                        <div>Approved: <span style="color:#4ade80; font-weight:600;">{{ $approvedCount }}</span></div>
                        <div>Completed: <span style="color:#60a5fa; font-weight:600;">{{ $completedCount }}</span></div>
                    </div>
                </div>

                <div class="card" style="flex:1 1 0; padding:0.9rem;">
                    <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.5rem;">
                        Quick actions
                    </h2>
                    <div style="display:flex; flex-direction:column; gap:0.4rem; font-size:0.85rem;">
                        <a href="{{ route('admin.bookings') }}" class="btn glow-btn"
                           style="padding:0.3rem 0.7rem; text-align:left;">
                            View all bookings
                        </a>
                        <a href="{{ route('admin.services') }}" class="btn glow-btn"
                           style="padding:0.3rem 0.7rem; text-align:left;">
                            Manage services
                        </a>
                        <a href="{{ route('admin.staff') }}" class="btn glow-btn"
                           style="padding:0.3rem 0.7rem; text-align:left;">
                            Manage staff &amp; schedules
                        </a>
                        <a href="{{ route('admin.reports') }}" class="btn glow-btn"
                           style="padding:0.3rem 0.7rem; text-align:left;">
                            Open detailed reports
                        </a>
                    </div>
                </div>
            </div>

            {{-- Recent bookings (different from detailed reports) --}}
            <div class="card" style="overflow-x:auto;">
                <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.6rem;">
                    Recent bookings
                </h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Date &amp; time</th>
                            <th>Status</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($recentBookings as $b)
                            @php
                                $dt = \Carbon\Carbon::parse($b->date.' '.$b->time);
                            @endphp
                            <tr>
                                <td>#{{ $b->id }}</td>
                                <td>{{ $b->customer_name }}</td>
                                <td>{{ $b->service?->name ?? 'Service removed' }}</td>
                                <td>
                                    <div style="font-size:0.85rem; color:#e5e7eb;">
                                        {{ $dt->format('d M Y') }}
                                    </div>
                                    <div style="font-size:0.8rem; color:#9ca3af;">
                                        {{ $dt->format('h:i A') }}
                                    </div>
                                </td>
                                <td>{{ $b->status }}</td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" style="font-size:0.85rem; color:#9ca3af; text-align:center;">
                                    No bookings have been created yet. Once customers start booking,
                                    the latest appointments will appear here for a quick overview, 
                                    while detailed trends remain under Reports.[file:1]
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
