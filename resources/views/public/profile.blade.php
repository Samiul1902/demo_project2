<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up" style="max-width:720px; margin:0 auto;">
            <h1 style="font-size:1.7rem; font-weight:800; margin-bottom:0.4rem;">
                My profile
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                Manage your personal details and booking preferences so the system can
                prefill future appointments, as required by FR‑1.[file:1]
            </p>

            @if(session('status'))
                <div class="card"
                     style="margin-bottom:1rem; font-size:0.85rem; color:#bbf7d0; border-color:rgba(34,197,94,0.4);">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card">
                <form method="POST" action="{{ route('public.profile.update') }}">
                    @csrf

                    {{-- Name --}}
                    <div style="margin-bottom:0.9rem;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Full name *
                        </label>
                        <input type="text"
                               name="name"
                               value="{{ old('name', $customer->name ?? '') }}"
                               required
                               style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                    </div>

                    {{-- Phone --}}
                    <div style="margin-bottom:0.9rem;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Phone number *
                        </label>
                        <input type="text"
                               name="phone"
                               value="{{ old('phone', $customer->phone ?? '') }}"
                               required
                               style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                        <p style="font-size:0.75rem; color:#64748b; margin-top:0.2rem;">
                            This number is used for booking confirmations and SMS reminders (FR‑8).[file:1]
                        </p>
                    </div>

                    {{-- Email --}}
                    <div style="margin-bottom:0.9rem;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Email (optional)
                        </label>
                        <input type="email"
                               name="email"
                               value="{{ old('email', $customer->email ?? '') }}"
                               style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                    </div>

                    {{-- Preferences --}}
                    <div class="row" style="gap:0.9rem; margin-bottom:0.9rem;">
                        <div style="flex:1 1 0;">
                            <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                                Preferred branch
                            </label>
                            <input type="text"
                                   name="preferred_branch"
                                   value="{{ old('preferred_branch', $customer->preferred_branch ?? '') }}"
                                   placeholder="e.g., Banani Branch"
                                   style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                        </div>
                        <div style="flex:1 1 0;">
                            <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                                Preferred stylist
                            </label>
                            <input type="text"
                                   name="preferred_stylist"
                                   value="{{ old('preferred_stylist', $customer->preferred_stylist ?? '') }}"
                                   placeholder="e.g., Ayesha"
                                   style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                        </div>
                    </div>

                    <button type="submit"
                            class="btn btn-pink glow-btn"
                            style="width:100%; margin-top:0.25rem;">
                        Save profile
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
