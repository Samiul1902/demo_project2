<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up" style="max-width:420px; margin:0 auto;">
            <h1 style="font-size:1.5rem; font-weight:800; margin-bottom:0.4rem;">
                Admin login
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                Restricted area for salon owners and managers, aligning with RBAC security
                requirements (NFR‑9).[file:1]
            </p>

            <div class="card">
                @if($errors->any())
                    <div style="font-size:0.85rem; color:#fecaca; margin-bottom:0.6rem;">
                        {{ $errors->first('password') }}
                    </div>
                @endif

                <form method="POST" action="{{ route('admin.login.submit') }}">
                    @csrf

                    <div style="margin-bottom:0.9rem;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Admin password
                        </label>
                        <input type="password"
                               name="password"
                               required
                               style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                    </div>

                    <button type="submit"
                            class="btn btn-pink glow-btn"
                            style="width:100%;">
                        Sign in
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
