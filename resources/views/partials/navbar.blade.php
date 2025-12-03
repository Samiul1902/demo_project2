<nav class="navbar">
    <div class="container navbar-inner">
        <a href="{{ route('home') }}" class="navbar-brand">
            SSBP<span>RMS</span>
        </a>
        <div class="nav-links">
            <a href="{{ route('public.services') }}">Services</a>
            <a href="{{ route('public.booking') }}">Book</a>
            <a href="{{ route('public.bookings') }}">My Bookings</a>
            <a href="{{ route('public.profile') }}">Profile</a>
            <a href="{{ route('admin.dashboard') }}">Admin</a>
        </div>
    </div>
</nav>
