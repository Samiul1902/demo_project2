<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                My bookings
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.6rem;">
                View your upcoming and past appointments. Later, cancellation and
                rescheduling rules will follow the time-window policy described in the
                business rules (e.g., 24 hours before appointment).[file:1]
            </p>

            {{-- Status flash after creating booking --}}
            @if(session('status'))
                <div class="card" style="margin-bottom:1rem; border-color:#22c55e;">
                    <p style="font-size:0.85rem; color:#22c55e; margin:0;">
                        {{ session('status') }}
                    </p>
                </div>
            @endif

            {{-- Simple tab bar (visual only for now) --}}
            <div style="display:flex; gap:0.75rem; margin-bottom:1.3rem; font-size:0.85rem;">
                <button type="button" class="btn btn-pink glow-btn" style="padding:0.4rem 1rem;">
                    All
                </button>
            </div>

            @php
                $today = now()->toDateString();
            @endphp

            <div style="display:flex; flex-direction:column; gap:0.9rem;">
                @forelse($bookings as $b)
                    @php
                        $isUpcoming = $b->date >= $today;
                        $statusClass = match ($b->status) {
                            'Pending'   => 'status-pending',
                            'Approved'  => 'status-approved',
                            'Rejected'  => 'status-rejected',
                            'Completed' => 'status-completed',
                            default     => 'status-default',
                        };
                    @endphp

                    <div class="card">
                        <div style="display:flex; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
                            <div style="flex:1 1 220px;">
                                <p style="font-size:0.8rem; color:#9ca3af; margin:0 0 0.25rem 0;">
                                    Booking ID:
                                    <span style="color:#e5e7eb;">#{{ $b->id }}</span>
                                </p>
                                <p style="font-size:0.95rem; font-weight:600; margin:0 0 0.2rem 0;">
                                    {{ $b->service?->name ?? 'Service removed' }}
                                </p>
                                <p style="font-size:0.8rem; color:#9ca3af; margin:0 0 0.2rem 0;">
                                    {{ $b->branch }}
                                </p>
                                <p style="font-size:0.8rem; color:#9ca3af; margin:0;">
                                    {{ \Carbon\Carbon::parse($b->date)->format('d M Y') }},
                                    {{ $b->time }} •
                                    <span class="{{ $statusClass }}">
                                        {{ $b->status }}
                                    </span>
                                </p>
                            </div>

                            <div style="display:flex; flex-direction:column; gap:0.4rem; align-items:flex-end; flex:0 0 180px;">
                                @if($isUpcoming && in_array($b->status, ['Pending','Approved']))
                                    <button type="button"
                                            class="btn glow-btn"
                                            style="width:100%; background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                                            data-booking-id="{{ $b->id }}"
                                            onclick="openRescheduleModal(this)">
                                        Reschedule
                                    </button>
                                    <button type="button"
                                            class="btn btn-pink glow-btn"
                                            style="width:100%; background:#b91c1c; border-color:#b91c1c;"
                                            data-booking-id="{{ $b->id }}"
                                            onclick="openCancelModal(this)">
                                        Cancel
                                    </button>
                                @else
                                    <span style="font-size:0.8rem; color:#9ca3af;">
                                        No actions available
                                    </span>
                                @endif
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="font-size:0.85rem; color:#9ca3af;">
                        You have no bookings yet. Go to the services page to book your first appointment.[file:1]
                    </p>
                @endforelse
            </div>
        </div>
    </section>

    {{-- Cancel modal --}}
    <div id="cancelModal" class="modal-backdrop">
        <div class="modal-card fade-in-up">
            <h2 style="font-size:1.2rem; font-weight:800; margin-bottom:0.5rem;">
                Cancel booking
            </h2>
            <p style="font-size:0.85rem; color:#9ca3af; margin-bottom:0.8rem;">
                You are about to cancel booking <span id="cancelBookingId" style="color:#fb7185;"></span>.
                In the final system, cancellation will only be allowed before the configured
                cut‑off time according to the business rules (OR‑10).[file:1]
            </p>
            <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                <button type="button" class="btn glow-btn"
                        style="background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                        onclick="closeCancelModal()">
                    Keep booking
                </button>
                <button type="button" class="btn btn-pink glow-btn"
                        style="background:#b91c1c; border-color:#b91c1c;">
                    Confirm cancel (UI)
                </button>
            </div>
        </div>
    </div>

    {{-- Reschedule modal --}}
    <div id="rescheduleModal" class="modal-backdrop">
        <div class="modal-card fade-in-up">
            <h2 style="font-size:1.2rem; font-weight:800; margin-bottom:0.5rem;">
                Reschedule booking
            </h2>
            <p style="font-size:0.85rem; color:#9ca3af; margin-bottom:0.75rem;">
                Select a new date and time for booking <span id="rescheduleBookingId" style="color:#fb7185;"></span>.
                Later, the backend will check staff availability and timing rules before approving
                the change (FR‑6, FR‑12).[file:1]
            </p>
            <div class="row" style="gap:0.75rem; margin-bottom:0.9rem;">
                <div style="flex:1 1 0;">
                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                        New date
                    </label>
                    <input type="date"
                           style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                </div>
                <div style="flex:1 1 0;">
                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                        New time
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
            <div style="display:flex; gap:0.5rem; justify-content:flex-end;">
                <button type="button" class="btn glow-btn"
                        style="background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                        onclick="closeRescheduleModal()">
                    Close
                </button>
                <button type="button" class="btn btn-pink glow-btn">
                    Save changes (UI)
                </button>
            </div>
        </div>
    </div>

    <script>
        function openCancelModal(button) {
            const id = button.getAttribute('data-booking-id');
            document.getElementById('cancelBookingId').textContent = '#' + id;
            document.getElementById('cancelModal').classList.add('show');
        }
        function closeCancelModal() {
            document.getElementById('cancelModal').classList.remove('show');
        }

        function openRescheduleModal(button) {
            const id = button.getAttribute('data-booking-id');
            document.getElementById('rescheduleBookingId').textContent = '#' + id;
            document.getElementById('rescheduleModal').classList.add('show');
        }
        function closeRescheduleModal() {
            document.getElementById('rescheduleModal').classList.remove('show');
        }
    </script>
</x-app-layout>
