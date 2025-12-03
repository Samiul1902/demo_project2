<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Reports &amp; analytics
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.6rem;">
                View revenue, appointment trends, and staff performance. Later this page
                will use real queries and charts to meet FR‑13 and FR‑14 of the SRS.[file:1]
            </p>

            {{-- Filters --}}
            <div style="display:flex; flex-wrap:wrap; gap:0.75rem; margin-bottom:1.2rem; font-size:0.85rem;">
                <select class="select">
                    <option>Range: Last 7 days</option>
                    <option>Today</option>
                    <option>This month</option>
                    <option>Last 3 months</option>
                    <option>This year</option>
                </select>
                <select class="select">
                    <option>Branch: All</option>
                    <option>Banani</option>
                    <option>Dhanmondi</option>
                    <option>Gulshan</option>
                </select>
            </div>

            {{-- KPI row --}}
            <div style="display:grid; gap:1rem; margin-bottom:1.8rem;">
                <div class="card">
                    <p style="font-size:0.8rem; color:#9ca3af; margin:0 0 0.3rem 0;">Total revenue</p>
                    <p style="font-size:1.6rem; font-weight:800; margin:0 0 0.15rem 0;">BDT 2,45,000</p>
                    <p style="font-size:0.8rem; color:#22c55e; margin:0;">+12% vs previous period</p>
                </div>
                <div class="card">
                    <p style="font-size:0.8rem; color:#9ca3af; margin:0 0 0.3rem 0;">Total appointments</p>
                    <p style="font-size:1.6rem; font-weight:800; margin:0 0 0.15rem 0;">312</p>
                    <p style="font-size:0.8rem; color:#9ca3af; margin:0;">No‑show rate: 4%</p>
                </div>
                <div class="card">
                    <p style="font-size:0.8rem; color:#9ca3af; margin:0 0 0.3rem 0;">Top branch (by revenue)</p>
                    <p style="font-size:1.1rem; font-weight:700; margin:0 0 0.15rem 0;">Banani</p>
                    <p style="font-size:0.8rem; color:#9ca3af; margin:0;">BDT 1,10,000</p>
                </div>
            </div>

            <div class="row" style="gap:2rem;">
                {{-- Revenue trend placeholder --}}
                <div class="col-half">
                    <div class="card">
                        <h2 style="font-size:1.05rem; font-weight:700; margin-bottom:0.75rem;">
                            Revenue trend (demo)
                        </h2>
                        <div style="height:200px; border-radius:1rem; background:
                            linear-gradient(135deg, rgba(34,197,94,0.3), rgba(59,130,246,0.3));
                            position:relative; overflow:hidden;">
                            <p style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:0.8rem; color:#e5e7eb;">
                                Placeholder chart – will be a real chart in backend
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Top services --}}
                <div class="col-half">
                    <div class="card">
                        <h2 style="font-size:1.05rem; font-weight:700; margin-bottom:0.75rem;">
                            Top services
                        </h2>

                        @php
                            $topServices = [
                                ['name' => 'Premium Haircut', 'count' => 120, 'revenue' => 96000],
                                ['name' => 'Facial Treatment', 'count' => 80,  'revenue' => 96000],
                                ['name' => 'Hair Spa',         'count' => 45,  'revenue' => 67500],
                            ];

                            // For relative bar widths
                            $maxCount = max(array_column($topServices, 'count'));
                        @endphp

                        <div style="display:flex; flex-direction:column; gap:0.6rem;">
                            @foreach($topServices as $ts)
                                @php
                                    $barWidth = $maxCount > 0 ? intval($ts['count'] * 100 / $maxCount) : 0;
                                @endphp
                                <div>
                                    <div style="display:flex; justify-content:space-between; font-size:0.85rem; margin-bottom:0.15rem;">
                                        <span>{{ $ts['name'] }}</span>
                                        <span>{{ $ts['count'] }} appts • BDT {{ $ts['revenue'] }}</span>
                                    </div>
                                    <div style="height:6px; border-radius:999px; background:#020617; overflow:hidden;">
                                        <div style="height:100%; background:linear-gradient(90deg,#fb7185,#8b5cf6); <?php echo 'width:' . $barWidth . '%;'; ?>"></div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            {{-- Staff performance summary --}}
            <div style="margin-top:2rem;" class="fade-in-up delay-1">
                <div class="card">
                    <h2 style="font-size:1.05rem; font-weight:700; margin-bottom:0.75rem;">
                        Staff performance (example)
                    </h2>

                    @php
                        $staffPerf = [
                            ['name' => 'Ayesha', 'branch' => 'Banani',    'rating' => 4.8, 'completed' => 96],
                            ['name' => 'Fahim',  'branch' => 'Dhanmondi', 'rating' => 4.6, 'completed' => 72],
                            ['name' => 'Nadia',  'branch' => 'Gulshan',   'rating' => 4.9, 'completed' => 54],
                        ];
                    @endphp

                    <table class="table">
                        <thead>
                            <tr>
                                <th>Staff</th>
                                <th>Branch</th>
                                <th>Completed appts</th>
                                <th>Avg rating</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($staffPerf as $sp)
                                <tr>
                                    <td>{{ $sp['name'] }}</td>
                                    <td>{{ $sp['branch'] }}</td>
                                    <td>{{ $sp['completed'] }}</td>
                                    <td>{{ $sp['rating'] }}★</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
