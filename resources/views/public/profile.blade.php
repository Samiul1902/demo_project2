<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                My profile
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.6rem;">
                Manage your personal details and preferences. Later this will be connected
                to the real user account to satisfy the profile management requirement (FR‑1).[file:1]
            </p>

            <div class="row" style="gap:2rem;">
                {{-- Left: profile form --}}
                <div class="col-half">
                    <div class="card">
                        <h2 style="font-size:1.1rem; font-weight:700; margin-bottom:0.9rem;">
                            Personal information
                        </h2>

                        <form>
                            <div style="margin-bottom:0.8rem;">
                                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                    Full name
                                </label>
                                <input type="text"
                                       value="Demo User"
                                       style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.5rem 0.8rem; font-size:0.9rem;">
                            </div>

                            <div style="margin-bottom:0.8rem;">
                                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                    Email
                                </label>
                                <input type="email"
                                       value="demo@example.com"
                                       style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.5rem 0.8rem; font-size:0.9rem;">
                            </div>

                            <div style="margin-bottom:0.8rem;">
                                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                    Phone (for SMS reminders)
                                </label>
                                <input type="text"
                                       value="+8801XXXXXXXXX"
                                       style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.5rem 0.8rem; font-size:0.9rem;">
                            </div>

                            <div style="margin-bottom:1rem;">
                                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                    Preferred language
                                </label>
                                <select class="select" style="width:100%;">
                                    <option>English</option>
                                    <option>Bangla</option>
                                </select>
                            </div>

                            <button type="button" class="btn btn-pink glow-btn" style="width:100%;">
                                Save changes (UI only)
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Right: preferences + summary --}}
                <div class="col-half">
                    <div class="card" style="margin-bottom:1.2rem;">
                        <h2 style="font-size:1.05rem; font-weight:700; margin-bottom:0.7rem;">
                            Service preferences
                        </h2>
                        <div style="margin-bottom:0.6rem;">
                            <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                Favorite categories
                            </label>
                            <div style="display:flex; flex-wrap:wrap; gap:0.4rem;">
                                <span class="badge-pink">Hair Care</span>
                                <span class="badge-pink">Skin Care</span>
                                <span class="badge-pink">Spa</span>
                            </div>
                        </div>

                        <div style="margin-bottom:0.6rem;">
                            <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                Notes for stylists
                            </label>
                            <textarea rows="3"
                                      style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.5rem 0.8rem; font-size:0.85rem; resize:vertical;"
                                      placeholder="Example: Sensitive skin, prefers mild products."></textarea>
                        </div>

                        <p style="font-size:0.8rem; color:#9ca3af;">
                            These preferences can later be used by the AI recommendation
                            engine to suggest better services based on your history (FR‑17).[file:1]
                        </p>
                    </div>

                    <div class="card">
                        <h2 style="font-size:1.05rem; font-weight:700; margin-bottom:0.7rem;">
                            Account overview
                        </h2>
                        <p style="font-size:0.85rem; color:#e5e7eb; margin-bottom:0.4rem;">
                            Total completed bookings: <strong>12</strong>
                        </p>
                        <p style="font-size:0.85rem; color:#e5e7eb; margin-bottom:0.4rem;">
                            Active loyalty points: <strong style="color:#4ade80;">450</strong>
                        </p>
                        <p style="font-size:0.8rem; color:#9ca3af;">
                            Loyalty points and membership are part of the additional features
                            defined in the SRS and will be used during payment and discounts (FR‑20).[file:1]
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>
</x-app-layout>
