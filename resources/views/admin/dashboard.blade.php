<x-app-layout>
    <section style="padding: 2.8rem 0 3.2rem 0;">
        <div class="container fade-in-up">

            {{-- Hero header --}}
            <div style="display:flex; justify-content:space-between; align-items:flex-end; gap:1rem; margin-bottom:1.6rem;">
                <div>
                    <h1 style="font-size:1.9rem; font-weight:800; margin-bottom:0.25rem;">
                        Salon control center
                    </h1>
                    <p style="font-size:0.92rem; color:#9ca3af;">
                        Monitor today’s flow and jump into bookings, services, and staff
                        management (FR‑9).[file:1]
                    </p>
                </div>
                <div style="text-align:right; font-size:0.8rem; color:#9ca3af;">
                    <div>{{ now()->format('l, d M Y') }}</div>
                    <div style="opacity:0.7;">Bangladesh Standard Time</div>
                </div>
            </div>

            @if(session('status'))
                <div class="card"
                     style="margin-bottom:1.2rem; font-size:0.85rem; color:#bbf7d0; border-color:rgba(34,197,94,0.4);">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Glassy stat cards --}}
            <div class="row" style="gap:1rem; margin-bottom:1.6rem;">
                @php
                    $cards = [
                        [
                            'label' => 'Today’s bookings',
                            'value' => $kpis['today_bookings'] ?? 0,
                        ],
                        [
                            'label' => 'Today’s revenue',
                            'value' => 'BDT '.number_format($kpis['today_revenue'] ?? 0, 2),
                        ],
                        [
                            'label' => 'Pending approvals',
                            'value' => $kpis['pending_bookings'] ?? 0,
                        ],
                        [
                            'label' => 'Active branches',
                            'value' => $kpis['active_branches'] ?? 0,
                        ],
                    ];
                @endphp

                @foreach($cards as $card)
                    <div class="card"
                         style="flex:1 1 0; padding:1rem 1.1rem; background:rgba(15,23,42,0.7); backdrop-filter:blur(10px); border-color:rgba(148,163,184,0.25);">
                        <div style="font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                            {{ $card['label'] }}
                        </div>
                        <div style="font-size:1.5rem; font-weight:700;">
                            {{ $card['value'] }}
                        </div>
                    </div>
                @endforeach
            </div>

            {{-- Main two‑column layout --}}
            <div class="row" style="gap:1.2rem; align-items:stretch;">

                {{-- Management shortcuts --}}
                <div class="card" style="flex:1 1 0; padding:1rem 1.1rem;">
                    <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.7rem;">
                        Quick actions
                    </h2>

                    <div style="display:flex; flex-direction:column; gap:0.55rem; font-size:0.9rem;">
                        <a href="{{ route('admin.bookings') }}"
                           style="display:flex; justify-content:space-between; align-items:center; text-decoration:none; color:inherit; padding:0.55rem 0.65rem; border-radius:0.6rem; background:rgba(15,23,42,0.7);">
                            <span>
                                Manage bookings
                                <span style="display:block; font-size:0.78rem; color:#9ca3af;">
                                    Approve / reject / complete appointments (FR‑12, FR‑13).[file:1]
                                </span>
                            </span>
                            <span style="font-size:0.85rem; color:#9ca3af;">➜</span>
                        </a>

                        <a href="{{ route('admin.services') }}"
                           style="display:flex; justify-content:space-between; align-items:center; text-decoration:none; color:inherit; padding:0.55rem 0.65rem; border-radius:0.6rem; background:rgba(15,23,42,0.7);">
                            <span>
                                Services &amp; pricing
                                <span style="display:block; font-size:0.78rem; color:#9ca3af;">
                                    Update catalog, durations, and prices (FR‑10).[file:1]
                                </span>
                            </span>
                            <span style="font-size:0.85rem; color:#9ca3af;">➜</span>
                        </a>

                        <a href="{{ route('admin.staff') }}"
                           style="display:flex; justify-content:space-between; align-items:center; text-decoration:none; color:inherit; padding:0.55rem 0.65rem; border-radius:0.6rem; background:rgba(15,23,42,0.7);">
                            <span>
                                Staff &amp; schedules
                                <span style="display:block; font-size:0.78rem; color:#9ca3af;">
                                    Configure stylists and availability (FR‑11).[file:1]
                                </span>
                            </span>
                            <span style="font-size:0.85rem; color:#9ca3af;">➜</span>
                        </a>

                        <a href="{{ route('admin.branches') }}"
                           style="display:flex; justify-content:space-between; align-items:center; text-decoration:none; color:inherit; padding:0.55rem 0.65rem; border-radius:0.6rem; background:rgba(15,23,42,0.7);">
                            <span>
                                Branches
                                <span style="display:block; font-size:0.78rem; color:#9ca3af;">
                                    Multi‑branch configuration (FR‑16).[file:1]
                                </span>
                            </span>
                            <span style="font-size:0.85rem; color:#9ca3af;">➜</span>
                        </a>

                        <a href="{{ route('admin.reports') }}"
                           style="display:flex; justify-content:space-between; align-items:center; text-decoration:none; color:inherit; padding:0.55rem 0.65rem; border-radius:0.6rem; background:rgba(15,23,42,0.7); margin-top:0.2rem;">
                            <span>
                                Reports &amp; analytics
                                <span style="display:block; font-size:0.78rem; color:#9ca3af;">
                                    Open detailed revenue and trend reports (FR‑14, FR‑15).[file:1]
                                </span>
                            </span>
                            <span style="font-size:0.85rem; color:#9ca3af;">➜</span>
                        </a>
                    </div>
                </div>

                {{-- Recent bookings --}}
                <div class="card" style="flex:2 1 0; overflow-x:auto; padding:1rem 1.1rem;">
                    <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.6rem;">
                        <h2 style="font-size:1rem; font-weight:700;">
                            Recent bookings
                        </h2>
                        <a href="{{ route('admin.bookings') }}"
                           class="btn btn-ghost"
                           style="font-size:0.8rem; padding:0.25rem 0.7rem;">
                            View all
                        </a>
                    </div>

                    <table class="table">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Service</th>
                                <th>Customer</th>
                                <th>Date</th>
                                <th>Time</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($recentBookings as $b)
                                <tr>
                                    <td>{{ $b->id }}</td>
                                    <td>{{ $b->service?->name ?? 'Service' }}</td>
                                    <td>{{ $b->customer_name }}</td>
                                    <td>{{ optional($b->date)->format('d M Y') ?? $b->date }}</td>
                                    <td>{{ $b->time }}</td>
                                    <td>
                                        <span class="badge badge-{{ strtolower($b->status) }}">
                                            {{ $b->status }}
                                        </span>
                                    </td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6"
                                        style="font-size:0.85rem; color:#9ca3af; text-align:center;">
                                        No bookings yet. When customers start booking online
                                        (FR‑3–FR‑6), they will appear here.[file:1]
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>

        </div>
    </section>
</x-app-layout>
