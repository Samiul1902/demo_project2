<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Recommended for you
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                A simple recommendation list based on your profile, preferred branch, and
                previous bookings, acting as a prototype for the AI recommendation feature
                in FR‑17.[file:1]
            </p>

            @if(!$customer)
                <div class="card" style="margin-bottom:1rem; font-size:0.85rem; color:#9ca3af;">
                    Create a profile and make your first booking so we can personalize
                    these suggestions better (FR‑1, FR‑3, FR‑17).[file:1]
                </div>
            @endif

            <div class="row" style="gap:1rem;">
                @forelse($recommended as $service)
                    <div class="card" style="flex:1 1 250px;">
                        <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.3rem;">
                            {{ $service->name }}
                        </h2>
                        <p style="font-size:0.85rem; color:#9ca3af; margin-bottom:0.4rem;">
                            BDT {{ $service->price }} • {{ $service->duration }} min
                        </p>
                        <p style="font-size:0.8rem; color:#9ca3af; margin-bottom:0.6rem;">
                            Suggested because it is popular and matches your preferences.
                        </p>
                        <a href="{{ route('public.booking', $service) }}"
                           class="btn btn-pink glow-btn"
                           style="width:100%; font-size:0.85rem;">
                            Book this service
                        </a>
                    </div>
                @empty
                    <div class="card" style="font-size:0.85rem; color:#9ca3af;">
                        No services are available yet. Once admins add active services and
                        customers start booking, this page will highlight suitable options,
                        preparing for deeper AI integration as described in the SRS.[file:1]
                    </div>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
