<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.8rem; font-weight:800; margin-bottom:0.4rem;">
                Our services
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.6rem;">
                Browse salon and beauty services with transparent pricing and duration.
                These services are managed from the admin panel as required by FR‑2 and FR‑10.[file:1]
            </p>

            {{-- Filters (UI only for now) --}}
            <div style="display:flex; flex-wrap:wrap; gap:0.75rem; margin-bottom:1.4rem; font-size:0.85rem;">
                <select class="select">
                    <option>All categories</option>
                    <option>Hair</option>
                    <option>Skin</option>
                    <option>Makeup</option>
                    <option>Spa</option>
                    <option>Package</option>
                </select>
                <select class="select">
                    <option>All branches</option>
                    <option>Banani</option>
                    <option>Dhanmondi</option>
                    <option>Gulshan</option>
                </select>
                <input type="text"
                       placeholder="Search services..."
                       style="flex:1 1 220px; min-width:160px; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.4rem 0.8rem;">
            </div>

            {{-- Services grid --}}
            <div class="row" style="gap:1.5rem; flex-wrap:wrap;">
                @forelse($services as $service)
                    <article class="card" style="flex:1 1 260px; max-width:320px;">
                        <h2 style="font-size:1.05rem; font-weight:700; margin-bottom:0.4rem;">
                            {{ $service->name }}
                        </h2>

                        @if($service->category || $service->branch)
                            <p style="font-size:0.8rem; color:#9ca3af; margin-bottom:0.35rem;">
                                @if($service->category)
                                    Category: {{ $service->category }}
                                @endif
                                @if($service->category && $service->branch)
                                    •
                                @endif
                                @if($service->branch)
                                    Branch: {{ $service->branch }}
                                @endif
                            </p>
                        @endif

                        <p style="font-size:0.85rem; color:#e5e7eb; margin-bottom:0.4rem;">
                            {{ $service->description ?? 'Professional service delivered by our expert staff.' }}
                        </p>

                        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.5rem; font-size:0.85rem;">
                            <span>
                                <span style="font-weight:600; color:#fb7185;">BDT {{ $service->price }}</span>
                                <span style="color:#9ca3af;"> • {{ $service->duration }} min</span>
                            </span>
                            <span style="display:flex; gap:0.3rem; font-size:0.75rem;">
                                <span class="badge-green">Popular</span>
                                <span class="badge-pink">Loyalty points</span>
                            </span>
                        </div>

                        {{-- Detail + booking CTAs --}}
                        <a href="{{ route('public.service.detail', $service) }}"
                           class="btn glow-btn"
                           style="width:100%; text-align:center; font-size:0.8rem; margin-bottom:0.35rem; background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;">
                            View details →
                        </a>

                        <a href="{{ route('public.booking', $service) }}"
                           class="btn btn-pink glow-btn"
                           style="width:100%; text-align:center; font-size:0.85rem;">
                            Book this service →
                        </a>
                    </article>
                @empty
                    <p style="font-size:0.85rem; color:#9ca3af;">
                        No services are available yet. Please add services from the admin panel.[file:1]
                    </p>
                @endforelse
            </div>
        </div>
    </section>
</x-app-layout>
