<x-app-layout>
    {{-- Background wrapper --}}
    <div style="
        position:relative;
        overflow:hidden;
        background:
            radial-gradient(circle at top left, rgba(251,113,133,0.14), transparent 55%),
            radial-gradient(circle at bottom right, rgba(56,189,248,0.14), transparent 55%),
            #020617;
    ">
        {{-- Soft glow blobs --}}
        <div style="
            position:absolute;
            inset:-120px;
            background:
                radial-gradient(circle at 10% 20%, rgba(251,113,133,0.10), transparent 50%),
                radial-gradient(circle at 80% 80%, rgba(59,130,246,0.10), transparent 50%);
            opacity:0.9;
            pointer-events:none;
        "></div>

        <div style="position:relative; z-index:1;">
            {{-- Hero --}}
            <section style="padding: 2.5rem 0 2.5rem 0;">
                <div class="container fade-in-up" style="display:flex; flex-wrap:wrap; gap:2rem; align-items:center;">
                    <div style="flex:1 1 260px; min-width:260px;">
                        <h1 class="hero-title-animate" style="font-size:2.1rem; font-weight:800; margin-bottom:0.6rem;">
                            Smart salon bookings, zero waiting.
                        </h1>

                        <p style="font-size:0.95rem; color:#9ca3af; margin-bottom:1.1rem;">
                            Book beauty and grooming services across multiple branches, manage your
                            appointments online, and enjoy transparent pricing with digital invoices.[file:1]
                        </p>
                        <div style="display:flex; flex-wrap:wrap; gap:0.6rem;">
                            <a href="{{ route('public.booking') }}" class="btn btn-pink glow-btn">
                                Get started
                            </a>
                            <a href="{{ route('public.services') }}"
                               class="btn glow-btn"
                               style="background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;">
                                Browse services
                            </a>
                        </div>
                    </div>

                    <div style="flex:1 1 260px; min-width:260px;">
                        <div class="card" style="
                            text-align:center;
                            backdrop-filter: blur(18px);
                            background:rgba(15,23,42,0.85);
                            border-color:rgba(148,163,184,0.4);
                        ">
                            <p style="font-size:0.85rem; color:#9ca3af; margin-bottom:0.3rem;">
                                Today’s overview
                            </p>
                            <p style="font-size:1.4rem; font-weight:700; margin-bottom:0.4rem;">
                                18 appointments
                            </p>
                            <p style="font-size:0.85rem; color:#9ca3af; margin-bottom:0;">
                                Running across Banani, Dhanmondi and Gulshan branches in real time.[file:1]
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Key features --}}
            <section style="padding: 0 0 2.2rem 0;">
                <div class="container fade-in-up">
                    <div class="row" style="gap:1.5rem;">
                        <div class="card glass-card" style="flex:1 1 220px;">
                            <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.3rem;">Online booking</h2>
                            <p style="font-size:0.85rem; color:#9ca3af;">
                                Choose service, stylist, date and time, then confirm your appointment in a few taps (FR‑3).[file:1]
                            </p>
                        </div>
                        <div class="card glass-card" style="flex:1 1 220px;">
                            <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.3rem;">Digital invoices</h2>
                            <p style="font-size:0.85rem; color:#9ca3af;">
                                Get instant confirmation and digital billing for every completed visit (FR‑4, FR‑13).[file:1]
                            </p>
                        </div>
                        <div class="card glass-card" style="flex:1 1 220px;">
                            <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.3rem;">Multi‑branch</h2>
                            <p style="font-size:0.85rem; color:#9ca3af;">
                                Centralized management for multiple salon branches as required by FR‑16.[file:1]
                            </p>
                        </div>
                    </div>
                </div>
            </section>

            {{-- Our branches --}}
            @php
                $branches = [
                    [
                        'name'        => 'Banani Branch',
                        'area'        => 'Banani, Dhaka',
                        'address'     => 'Road 11, House 32, Banani',
                        'phone'       => '+8801XXX‑000111',
                        'hours'       => '10:00 AM – 9:00 PM',
                        'tagline'     => 'Flagship branch with full hair, skin and spa services.',
                    ],
                    [
                        'name'        => 'Dhanmondi Branch',
                        'area'        => 'Dhanmondi, Dhaka',
                        'address'     => 'Road 27, House 15, Dhanmondi',
                        'phone'       => '+8801XXX‑000222',
                        'hours'       => '10:00 AM – 9:00 PM',
                        'tagline'     => 'Family‑friendly branch focused on quick haircuts and facials.',
                    ],
                    [
                        'name'        => 'Gulshan Branch',
                        'area'        => 'Gulshan, Dhaka',
                        'address'     => 'Gulshan Avenue, Block C',
                        'phone'       => '+8801XXX‑000333',
                        'hours'       => '11:00 AM – 10:00 PM',
                        'tagline'     => 'Premium bridal, party makeup and spa experiences.',
                    ],
                ];
            @endphp

            <section style="padding: 0 0 2.5rem 0;">
                <div class="container fade-in-up">
                    <div style="display:flex; justify-content:space-between; align-items:flex-end; gap:1rem; margin-bottom:1.3rem;">
                        <div>
                            <h2 style="font-size:1.4rem; font-weight:800; margin-bottom:0.3rem;">
                                Our branches
                            </h2>
                            <p style="font-size:0.85rem; color:#9ca3af; margin:0;">
                                Pick the branch that is closest to you; all bookings, staff schedules, and reports
                                are managed centrally for owners (FR‑9, FR‑11, FR‑16).[file:1]
                            </p>
                        </div>
                        <a href="{{ route('admin.branches') }}"
                           style="font-size:0.8rem; color:#fb7185; text-decoration:none;">
                            Admin: manage branches →
                        </a>
                    </div>

                    <div class="row" style="gap:1.5rem;">
                        @foreach($branches as $branch)
                            <article class="card glass-card" style="flex:1 1 240px;">
                                <h3 style="font-size:1.05rem; font-weight:700; margin-bottom:0.2rem;">
                                    {{ $branch['name'] }}
                                </h3>
                                <p style="font-size:0.8rem; color:#9ca3af; margin-bottom:0.4rem;">
                                    {{ $branch['area'] }}
                                </p>

                                <p style="font-size:0.85rem; color:#e5e7eb; margin-bottom:0.45rem;">
                                    {{ $branch['tagline'] }}
                                </p>

                                <div style="font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                                    <span style="color:#64748b;">Address:</span> {{ $branch['address'] }}
                                </div>
                                <div style="font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                                    <span style="color:#64748b;">Phone:</span> {{ $branch['phone'] }}
                                </div>
                                <div style="font-size:0.8rem; color:#9ca3af;">
                                    <span style="color:#64748b;">Hours:</span> {{ $branch['hours'] }}
                                </div>

                                <a href="{{ route('public.booking') }}"
                                   class="btn btn-pink glow-btn"
                                   style="margin-top:0.7rem; width:100%; text-align:center; font-size:0.85rem;">
                                    Book at {{ $branch['name'] }}
                                </a>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>

            {{-- Customer reviews --}}
            @php
                $reviews = [
                    [
                        'name'    => 'Rafi',
                        'branch'  => 'Banani Branch',
                        'rating'  => '4.9',
                        'comment' => 'Loved the premium haircut and the easy online booking experience.',
                    ],
                    [
                        'name'    => 'Sakib',
                        'branch'  => 'Dhanmondi Branch',
                        'rating'  => '4.8',
                        'comment' => 'Clean parlour, on‑time service, and clear pricing on every invoice.',
                    ],
                    [
                        'name'    => 'Sami',
                        'branch'  => 'Gulshan Branch',
                        'rating'  => '5.0',
                        'comment' => 'Bridal package was perfectly organized, with reminders before each visit.',
                    ],
                ];
            @endphp

            <section style="padding: 0 0 3rem 0;">
                <div class="container fade-in-up">
                    <h2 style="font-size:1.4rem; font-weight:800; margin-bottom:0.3rem;">
                        What customers say
                    </h2>
                    <p style="font-size:0.85rem; color:#9ca3af; margin-bottom:1.2rem;">
                        Ratings and feedback collected after completed services, as required by the
                        review feature (FR‑7).[file:1]
                    </p>

                    <div class="row" style="gap:1.5rem;">
                        @foreach($reviews as $review)
                            <article class="card glass-card" style="flex:1 1 260px;">
                                <div style="display:flex; justify-content:space-between; margin-bottom:0.3rem;">
                                    <span style="font-size:0.95rem; font-weight:600; color:#e5e7eb;">
                                        {{ $review['name'] }}
                                    </span>
                                    <span style="font-size:0.85rem; color:#facc15;">
                                        {{ $review['rating'] }}★
                                    </span>
                                </div>
                                <p style="font-size:0.8rem; color:#9ca3af; margin-bottom:0.4rem;">
                                    {{ $review['branch'] }}
                                </p>
                                <p style="font-size:0.85rem; color:#e5e7eb; margin:0;">
                                    {{ $review['comment'] }}
                                </p>
                            </article>
                        @endforeach
                    </div>
                </div>
            </section>
        </div>
    </div>
</x-app-layout>
