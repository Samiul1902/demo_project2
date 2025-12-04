<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up" style="max-width:720px; margin:0 auto;">
            <h1 style="font-size:1.7rem; font-weight:800; margin-bottom:0.4rem;">
                Share your feedback
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                Tell us about your experience, rate the service or staff, and help improve the
                salon, as described in the feedback requirement (FR‑7).[file:1]
            </p>

            @if(session('status'))
                <div class="card"
                     style="margin-bottom:1rem; font-size:0.85rem; color:#bbf7d0; border-color:rgba(34,197,94,0.4);">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card">
                <form method="POST" action="{{ route('public.feedback.store') }}">
                    @csrf

                    {{-- Optional booking reference --}}
                    <div style="margin-bottom:0.9rem;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Booking ID (optional)
                        </label>
                        <input type="number"
                               name="booking_id"
                               value="{{ old('booking_id') }}"
                               placeholder="e.g., 12"
                               style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                        <p style="font-size:0.75rem; color:#64748b; margin-top:0.2rem;">
                            If you know your booking number, enter it so we can link this feedback to that visit.
                        </p>
                    </div>

                    {{-- Name --}}
                    <div style="margin-bottom:0.9rem;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Your name *
                        </label>
                        <input type="text"
                               name="customer_name"
                               value="{{ old('customer_name') }}"
                               required
                               style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                    </div>

                    {{-- Phone --}}
                    <div style="margin-bottom:0.9rem;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Phone (optional)
                        </label>
                        <input type="text"
                               name="customer_phone"
                               value="{{ old('customer_phone') }}"
                               style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                    </div>

                    {{-- Target: service, staff or overall --}}
                    <div class="row" style="gap:0.9rem; margin-bottom:0.9rem;">
                        <div style="flex:1 1 0;">
                            <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                                Feedback about
                            </label>
                            <select name="target_type" class="select" style="width:100%;">
                                <option value="overall" {{ old('target_type') === 'overall' ? 'selected' : '' }}>Overall experience</option>
                                <option value="service" {{ old('target_type') === 'service' ? 'selected' : '' }}>Service</option>
                                <option value="staff" {{ old('target_type') === 'staff' ? 'selected' : '' }}>Staff</option>
                            </select>
                        </div>
                        <div style="flex:1 1 0;">
                            <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                                Name of service/staff (optional)
                            </label>
                            <input type="text"
                                   name="target_name"
                                   value="{{ old('target_name') }}"
                                   placeholder="e.g., Basic Haircut or Ayesha"
                                   style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                        </div>
                    </div>

                    {{-- Rating --}}
                    <div style="margin-bottom:0.9rem;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Rating (1–5 stars)
                        </label>
                        <select name="rating" class="select" style="width:100%;">
                            <option value="">No rating</option>
                            @for($i = 1; $i <= 5; $i++)
                                <option value="{{ $i }}" {{ old('rating') == $i ? 'selected' : '' }}>
                                    {{ $i }} ★
                                </option>
                            @endfor
                        </select>
                    </div>

                    {{-- Comments --}}
                    <div style="margin-bottom:1rem;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Comments
                        </label>
                        <textarea name="comments"
                                  rows="4"
                                  style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.55rem 0.8rem; font-size:0.85rem; resize:vertical;"
                                  placeholder="What did we do well? What can we improve?">{{ old('comments') }}</textarea>
                    </div>

                    <button type="submit"
                            class="btn btn-pink glow-btn"
                            style="width:100%;">
                        Submit feedback
                    </button>
                </form>
            </div>
        </div>
    </section>
</x-app-layout>
