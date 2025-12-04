<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <title>SSBP‑RMS – Smart Salon &amp; Beauty Parlour</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- Favicon for browser tab --}}
    <link rel="icon" type="image/png" href="{{ asset('images/WhatsApp_Image_2025-11-17_at_00.14.30-removebg-preview.png') }}">
    {{-- If you have a classic .ico, uncomment the next line --}}
    {{-- <link rel="icon" type="image/x-icon" href="{{ asset('images/WhatsApp_Image_2025-11-17_at_00.14.30-removebg-preview.pn') }}"> --}}

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>
<body class="bg-slate-950 text-slate-50">
    {{-- Top navigation bar with new logo --}}
    <header class="navbar">
        <div class="container navbar-inner">
            <a href="{{ route('home') }}" class="navbar-brand" style="display:flex; align-items:center; gap:0.6rem;">
                <span class="navbar-logo"
                      style="width:34px; height:34px; border-radius:999px; overflow:hidden; background:#111827; display:inline-flex; align-items:center; justify-content:center;">
                    <img src="{{ asset('images/logo-ssbp.png') }}"
                         alt="SSBP‑RMS"
                         style="width:100%; height:100%; object-fit:cover;">
                </span>
                <span style="display:flex; flex-direction:column;">
                    <span style="font-weight:700; font-size:0.95rem;">SSBP‑RMS</span>
                    <span style="font-size:0.7rem; color:#9ca3af;">
                        Smart Salon &amp; Beauty Parlour
                    </span>
                </span>
            </a>

            <nav class="navbar-links">
                <a href="{{ route('public.services') }}">Services</a>
                <a href="{{ route('public.booking') }}">Book</a>
                <a href="{{ route('public.bookings') }}">My bookings</a>
                <a href="{{ route('public.profile') }}">Profile</a>
                <a href="{{ route('admin.dashboard') }}" class="btn-small">
                    Admin
                </a>
            </nav>
        </div>
    </header>

    <main>
        {{ $slot }}
    </main>

    <footer class="footer">
        <div class="container footer-inner">
            <span style="font-size:0.75rem; color:#6b7280;">
                © 2025 Smart Salon &amp; Beauty Parlour RMS · BST · Digital Bangladesh Ready.[file:1]
            </span>
        </div>
    </footer>
</body>
</html>
