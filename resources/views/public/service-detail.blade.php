<x-app-layout>
    <section style="padding: 2.5rem 0;">
        <div class="container fade-in-up">
            {{-- Breadcrumb --}}
            <div style="font-size: 0.8rem; color:#9ca3af; margin-bottom: 1rem;">
                <a href="{{ route('home') }}" style="color:#e5e7eb; text-decoration:none;">Home</a>
                <span> / </span>
                <a href="{{ route('public.services') }}" style="color:#e5e7eb; text-decoration:none;">Services</a>
                <span> / </span>
                <span style="color:#f9fafb;">Premium Haircut</span>
            </div>

            <div class="row" style="gap:2rem;">
                {{-- Left: image + service info --}}
                <div class="col-half">
                    <div class="service-image" style="border-radius:1.5rem; margin-bottom:1rem;">
                        <span>Service Image</span>
                    </div>

                    <h1 style="font-size:1.8rem; font-weight:800; margin:0 0 0.5rem 0;">
                        Premium Haircut
                    </h1>

                    <div style="display:flex; align-items:center; gap:0.75rem; margin-bottom:0.75rem; font-size:0.9rem;">
                        <span style="font-weight:700; color:#fb7185;">BDT 800</span>
                        <span>•</span>
                        <span>⏱ 45 minutes</span>
                        <span>•</span>
                        <span style="font-size:0.8rem; color:#9ca3af;">Category: Hair Care</span>
                    </div>

                    <p style="font-size:0.9rem; color:#e5e7eb; margin-bottom:0.75rem;">
                        A tailored haircut experience designed around your face shape, lifestyle, and
                        styling preferences. Professional stylists use quality tools and products to
                        ensure a clean, modern look.
                    </p>

                    <p style="font-size:0.85rem; color:#9ca3af; margin-bottom:0.75rem;">
                        This service is ideal for customers who value convenience and transparency:
                        you can see pricing up front and check available slots before confirming
                        your booking, as required by the system specifications.[file:1]
                    </p>

                    {{-- Rating summary --}}
                    <div class="card" style="margin-top:0.5rem;">
                        <div style="display:flex; align-items:center; gap:0.5rem; margin-bottom:0.25rem;">
                            <span style="color:#facc15; font-size:1rem;">★★★★☆</span>
                            <span style="font-size:0.9rem; font-weight:600;">4.5 / 5</span>
                            <span style="font-size:0.75rem; color:#9ca3af;">(89 reviews)</span>
                        </div>
                        <p style="font-size:0.8rem; color:#9ca3af;">
                            Popular with working professionals and students looking for quick, high‑quality haircuts.
                        </p>
                    </div>
                </div>

                {{-- Right: booking panel --}}
                <div class="col-half">
                    <div class="card" style="position:sticky; top:1.5rem;">
                        <h2 style="font-size:1.1rem; font-weight:700; margin-bottom:0.75rem;">
                            Book this service
                        </h2>

                        <form class="fade-in-up delay-1">
                            {{-- Branch --}}
                            <div style="margin-bottom:0.75rem;">
                                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                    Select branch *
                                </label>
                                <select class="select" style="width:100%;">
                                    <option>Banani Branch</option>
                                    <option>Dhanmondi Branch</option>
                                    <option>Gulshan Branch</option>
                                </select>
                            </div>

                            {{-- Stylist --}}
                            <div style="margin-bottom:0.75rem;">
                                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                    Stylist preference
                                </label>
                                <select class="select" style="width:100%;">
                                    <option>Any available stylist</option>
                                    <option>Ayesha (4.8★)</option>
                                    <option>Fahim (4.6★)</option>
                                    <option>Nadia (4.9★)</option>
                                </select>
                            </div>

                            {{-- Date & time --}}
                            <div class="row" style="gap:0.75rem; margin-bottom:0.75rem;">
                                <div style="flex:1 1 0;">
                                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                        Date *
                                    </label>
                                    <input type="date"
                                           style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                                </div>
                                <div style="flex:1 1 0;">
                                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                        Time *
                                    </label>
                                    <select class="select" style="width:100%;">
                                        <option>10:00 AM</option>
                                        <option>11:30 AM</option>
                                        <option>3:30 PM</option>
                                        <option>4:15 PM</option>
                                        <option>5:00 PM</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Summary --}}
                            <div class="card" style="margin-bottom:0.75rem; padding:0.75rem 1rem;">
                                <div style="display:flex; justify-content:space-between; font-size:0.85rem; margin-bottom:0.2rem;">
                                    <span>Service price</span>
                                    <span>BDT 800</span>
                                </div>
                                <div style="display:flex; justify-content:space-between; font-size:0.8rem; color:#22c55e; margin-bottom:0.2rem;">
                                    <span>Estimated loyalty discount</span>
                                    <span>- BDT 50</span>
                                </div>
                                <div style="display:flex; justify-content:space-between; font-size:0.9rem; font-weight:700; margin-top:0.2rem;">
                                    <span>Total</span>
                                    <span style="color:#fb7185;">BDT 750</span>
                                </div>
                            </div>

                            {{-- Buttons --}}
                            <a href="{{ route('public.booking') }}"
                               class="btn btn-pink glow-btn"
                               style="width:100%; text-align:center; margin-bottom:0.5rem;">
                                Continue to full booking →
                            </a>

                            <button type="button"
                                    class="btn glow-btn"
                                    style="width:100%; background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;">
                                Ask AI assistant about this service
                            </button>
                            {{-- Later this button will open the AI chatbot (FR‑18). --}}
                        </form>
                    </div>
                </div>
            </div>

            {{-- Reviews list --}}
            <div style="margin-top:2.5rem;" class="fade-in-up delay-2">
                <h2 style="font-size:1.2rem; font-weight:700; margin-bottom:1rem;">
                    Customer reviews
                </h2>

                @for($i = 1; $i <= 3; $i++)
                    <div class="card" style="margin-bottom:0.75rem; padding:1rem 1.2rem;">
                        <div style="display:flex; gap:0.75rem;">
                            <div style="
                                width:2.2rem; height:2.2rem;
                                border-radius:999px;
                                background:linear-gradient(135deg,#fb7185,#8b5cf6);
                                display:flex; align-items:center; justify-content:center;
                                font-size:0.8rem; font-weight:700;">
                                U{{ $i }}
                            </div>
                            <div style="flex:1 1 0;">
                                <div style="display:flex; align-items:center; gap:0.4rem; margin-bottom:0.1rem;">
                                    <span style="font-size:0.9rem; font-weight:600;">Customer {{ $i }}</span>
                                    <span style="color:#facc15; font-size:0.8rem;">★★★★★</span>
                                </div>
                                <p style="font-size:0.75rem; color:#9ca3af; margin:0 0 0.25rem 0;">
                                    2 days ago
                                </p>
                                <p style="font-size:0.85rem; color:#e5e7eb; margin:0;">
                                    Excellent service and very friendly staff. Booking online was quick and easy.
                                </p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>
</x-app-layout>
