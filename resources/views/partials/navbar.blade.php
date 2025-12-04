<nav style="
    position:sticky;
    top:0;
    z-index:40;
    backdrop-filter: blur(16px);
    background:rgba(15,23,42,0.92);
    border-bottom:1px solid rgba(148,163,184,0.25);
">
    <div class="container"
         style="display:flex; align-items:center; justify-content:space-between; gap:1.5rem; padding:0.9rem 0;">
        {{-- Logo / title --}}
        <a href="{{ route('home') }}" style="display:flex; align-items:center; gap:0.55rem; text-decoration:none;">
            <div style="
                width:2.4rem;
                height:2.4rem;
                border-radius:999px;
                background:radial-gradient(circle at 30% 20%, #fb7185, #581c87);
                display:flex;
                align-items:center;
                justify-content:center;
                box-shadow:0 0 18px rgba(248,113,113,0.55);
            ">
                <span style="font-weight:800; font-size:1.1rem; color:#f9fafb;">
                    SS
                </span>
            </div>
            <div>
                <div style="font-size:1.05rem; font-weight:800; color:#f9fafb; letter-spacing:0.03em;">
                    SSBP‑RMS
                </div>
                <div style="font-size:0.75rem; color:#9ca3af;">
                    Smart Salon &amp; Beauty Parlour
                </div>
            </div>
        </a>

        {{-- Nav links --}}
        <div style="display:flex; align-items:center; gap:1.2rem; font-size:0.9rem;">
            <a href="{{ route('public.services') }}" class="nav-link">Services</a>
            <a href="{{ route('public.booking') }}" class="nav-link">Book</a>
            <a href="{{ route('public.bookings') }}" class="nav-link">My bookings</a>
            <a href="{{ route('public.profile') }}" class="nav-link">Profile</a>

            <span style="width:1px; height:1.8rem; background:rgba(148,163,184,0.28);"></span>

            <a href="{{ route('admin.dashboard') }}"
               class="btn glow-btn"
               style="padding:0.35rem 0.9rem; font-size:0.82rem; background:transparent; border-color:rgba(148,163,184,0.8); color:#e5e7eb;">
                Admin
            </a>
        </div>
    </div>
</nav>
