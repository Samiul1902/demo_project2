<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Admin dashboard
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.6rem;">
                Overview of today’s appointments, revenue, and customers. Later this
                dashboard will pull live data and charts as required by the admin module (FR‑9, FR‑14).[file:1]
            </p>

            {{-- KPI cards --}}
            <div style="display:grid; gap:1rem; margin-bottom:2rem;">
                <div class="card" style="background:rgba(15,23,42,0.95);">
                    <p style="font-size:0.8rem; color:#9ca3af; margin:0 0 0.25rem 0;">Today’s appointments</p>
                    <p style="font-size:1.6rem; font-weight:800; margin:0 0 0.15rem 0;">24</p>
                    <p style="font-size:0.8rem; color:#22c55e; margin:0;">+6 vs yesterday</p>
                </div>
                <div class="card" style="background:rgba(15,23,42,0.95);">
                    <p style="font-size:0.8rem; color:#9ca3af; margin:0 0 0.25rem 0;">Today’s revenue</p>
                    <p style="font-size:1.6rem; font-weight:800; margin:0 0 0.15rem 0;">BDT 18,400</p>
                    <p style="font-size:0.8rem; color:#9ca3af; margin:0;">Average ticket: BDT 767</p>
                </div>
                <div class="card" style="background:rgba(15,23,42,0.95);">
                    <p style="font-size:0.8rem; color:#9ca3af; margin:0 0 0.25rem 0;">New customers</p>
                    <p style="font-size:1.6rem; font-weight:800; margin:0 0 0.15rem 0;">7</p>
                    <p style="font-size:0.8rem; color:#9ca3af; margin:0;">This week</p>
                </div>
            </div>

            {{-- Charts + recent bookings layout --}}
            <div class="row" style="gap:2rem;">
                <div class="col-half">
                    <div class="card">
                        <h2 style="font-size:1.05rem; font-weight:700; margin-bottom:0.75rem;">
                            Appointments trend (demo)
                        </h2>
                        <div style="height:180px; border-radius:1rem; background:
                            linear-gradient(135deg, rgba(59,130,246,0.35), rgba(236,72,153,0.35));
                            position:relative; overflow:hidden;">
                            <p style="position:absolute; inset:0; display:flex; align-items:center; justify-content:center; font-size:0.8rem; color:#e5e7eb;">
                                Placeholder chart – will be replaced with real chart in backend (FR‑14).[file:1]
                            </p>
                        </div>
                    </div>
                </div>

                <div class="col-half">
                    <div class="card">
                        <h2 style="font-size:1.05rem; font-weight:700; margin-bottom:0.75rem;">
                            Today’s upcoming bookings
                        </h2>

                        @php
                            $adminBookings = [
                                ['time' => '15:30', 'service' => 'Premium Haircut', 'customer' => 'Rafi', 'branch' => 'Banani'],
                                ['time' => '16:00', 'service' => 'Facial Treatment', 'customer' => 'Sakib', 'branch' => 'Dhanmondi'],
                                ['time' => '17:00', 'service' => 'Hair Spa', 'customer' => 'Sami', 'branch' => 'Gulshan'],
                            ];
                        @endphp

                        <div style="display:flex; flex-direction:column; gap:0.6rem;">
                            @foreach($adminBookings as $ab)
                                <div style="display:flex; justify-content:space-between; gap:0.75rem; font-size:0.85rem;">
                                    <span style="color:#e5e7eb; min-width:3rem;">{{ $ab['time'] }}</span>
                                    <span style="flex:1 1 0; color:#e5e7eb;">{{ $ab['service'] }}</span>
                                    <span style="color:#9ca3af;">{{ $ab['customer'] }}</span>
                                    <span style="font-size:0.75rem; color:#a5b4fc;">{{ $ab['branch'] }}</span>
                                </div>
                            @endforeach
                        </div>

                        <div style="margin-top:0.75rem; text-align:right;">
                            <a href="{{ route('admin.bookings') }}" style="font-size:0.8rem; color:#fb7185; text-decoration:none;">
                                View all bookings →
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            {{-- Quick links --}}
            <div style="margin-top:2rem;" class="fade-in-up delay-1">
                <h2 style="font-size:1.05rem; font-weight:700; margin-bottom:0.75rem;">
                    Quick admin actions
                </h2>
                <div style="display:flex; flex-wrap:wrap; gap:0.75rem; font-size:0.85rem;">
                    <a href="{{ route('admin.services') }}" class="btn glow-btn">Manage services</a>
                    <a href="{{ route('admin.staff') }}" class="btn glow-btn">Manage staff &amp; schedules</a>
                    <a href="{{ route('admin.bookings') }}" class="btn glow-btn">Approve bookings</a>
                    <a href="{{ route('admin.reports') }}" class="btn glow-btn">View reports</a>
                    <a href="{{ route('admin.branches') }}" class="btn glow-btn">Branches</a>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
