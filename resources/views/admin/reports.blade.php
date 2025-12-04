<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Reports &amp; analytics
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                Revenue, booking trends, and loyalty points, supporting FR‑14 and FR‑15 for
                business insights.[file:1]
            </p>

            <form method="GET"
                  action="{{ route('admin.reports') }}"
                  style="margin-bottom:1rem; display:flex; gap:0.6rem; align-items:center;">
                <label style="font-size:0.8rem; color:#9ca3af;">
                    Range:
                </label>
                <select name="range"
                        class="select"
                        style="width:9rem; font-size:0.85rem;"
                        onchange="this.form.submit()">
                    <option value="day" {{ $range === 'day' ? 'selected' : '' }}>Today</option>
                    <option value="week" {{ $range === 'week' ? 'selected' : '' }}>This week</option>
                    <option value="month" {{ $range === 'month' ? 'selected' : '' }}>This month</option>
                </select>
            </form>

            <div class="row" style="gap:1rem; margin-bottom:1.2rem;">
                <div class="card" style="flex:1 1 0;">
                    <h2 style="font-size:0.9rem; color:#9ca3af; margin-bottom:0.2rem;">
                        Total revenue
                    </h2>
                    <div style="font-size:1.4rem; font-weight:700;">
                        BDT {{ number_format($summary->total_revenue ?? 0, 2) }}
                    </div>
                </div>
                <div class="card" style="flex:1 1 0;">
                    <h2 style="font-size:0.9rem; color:#9ca3af; margin-bottom:0.2rem;">
                        Total bookings
                    </h2>
                    <div style="font-size:1.4rem; font-weight:700;">
                        {{ $summary->total_bookings ?? 0 }}
                    </div>
                </div>
                <div class="card" style="flex:1 1 0;">
                    <h2 style="font-size:0.9rem; color:#9ca3af; margin-bottom:0.2rem;">
                        Loyalty points issued
                    </h2>
                    <div style="font-size:1.4rem; font-weight:700;">
                        {{ $summary->total_points ?? 0 }}
                    </div>
                </div>
            </div>

            <div class="row" style="gap:1rem;">
                <div class="card" style="flex:1 1 0; overflow-x:auto;">
                    <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.6rem;">
                        Top services
                    </h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Service</th>
                                <th>Bookings</th>
                                <th>Revenue (BDT)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($byService as $row)
                                <tr>
                                    <td>{{ $row->service?->name ?? 'Service' }}</td>
                                    <td>{{ $row->count }}</td>
                                    <td>{{ number_format($row->revenue, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="font-size:0.85rem; color:#9ca3af;">
                                        No completed bookings in this range yet.[file:1]
                                    </td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>

                <div class="card" style="flex:1 1 0; overflow-x:auto;">
                    <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.6rem;">
                        Revenue by branch
                    </h2>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Branch</th>
                                <th>Bookings</th>
                                <th>Revenue (BDT)</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($byBranch as $row)
                                <tr>
                                    <td>{{ $row->branch }}</td>
                                    <td>{{ $row->count }}</td>
                                    <td>{{ number_format($row->revenue, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="3" style="font-size:0.85rem; color:#9ca3af;">
                                        No data for this range yet.[file:1]
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
