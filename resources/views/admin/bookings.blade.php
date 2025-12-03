<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Manage bookings
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.6rem;">
                Review new appointment requests, approve or reject them, and monitor
                today’s schedule as required by the admin module (FR‑12).[file:1]
            </p>

            {{-- Filters --}}
            <div style="display:flex; flex-wrap:wrap; gap:0.75rem; margin-bottom:1rem; font-size:0.85rem;">
                <select class="select">
                    <option>Status: All</option>
                    <option>Pending</option>
                    <option>Approved</option>
                    <option>Rejected</option>
                    <option>Completed</option>
                </select>
                <select class="select">
                    <option>Branch: All</option>
                    <option>Banani</option>
                    <option>Dhanmondi</option>
                    <option>Gulshan</option>
                </select>
                <input type="date"
                       style="background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.35rem 0.8rem;">
                <input type="text"
                       placeholder="Search by customer or ID..."
                       style="flex:1 1 220px; min-width:160px; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.4rem 0.8rem;">
            </div>

            @php
                $adminBookings = [
                    ['id' => 'SSB-2025-001', 'time' => '15:30', 'service' => 'Premium Haircut', 'customer' => 'Rafi',  'branch' => 'Banani',    'status' => 'Pending',   'amount' => 800],
                    ['id' => 'SSB-2025-002', 'time' => '16:00', 'service' => 'Facial Treatment','customer' => 'Sakib', 'branch' => 'Dhanmondi','status' => 'Approved',  'amount' => 1200],
                    ['id' => 'SSB-2025-003', 'time' => '17:00', 'service' => 'Hair Spa',        'customer' => 'Sami',  'branch' => 'Gulshan',   'status' => 'Completed', 'amount' => 1500],
                ];
            @endphp

            <div class="card" style="overflow-x:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Booking ID</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Branch</th>
                            <th>Amount (BDT)</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($adminBookings as $b)
                            @php
                                $statusClass =
                                    $b['status'] === 'Pending'   ? 'badge-pink' :
                                    ($b['status'] === 'Approved' ? 'badge-green' : 'badge-green');
                            @endphp
                            <tr>
                                <td>{{ $b['time'] }}</td>
                                <td>{{ $b['id'] }}</td>
                                <td>{{ $b['customer'] }}</td>
                                <td>{{ $b['service'] }}</td>
                                <td>{{ $b['branch'] }}</td>
                                <td>{{ $b['amount'] }}</td>
                                <td>
                                    <span class="{{ $statusClass }}">{{ $b['status'] }}</span>
                                </td>
                                <td style="text-align:right;">
                                    @if($b['status'] === 'Pending')
                                        <button type="button"
                                                class="btn glow-btn"
                                                style="padding:0.3rem 0.7rem; font-size:0.8rem; background:#16a34a; border-color:#16a34a;"
                                                data-booking-id="{{ $b['id'] }}"
                                                onclick="openDecisionModal(this, 'approve')">
                                            Approve
                                        </button>
                                        <button type="button"
                                                class="btn btn-pink glow-btn"
                                                style="padding:0.3rem 0.7rem; font-size:0.8rem; background:#b91c1c; border-color:#b91c1c;"
                                                data-booking-id="{{ $b['id'] }}"
                                                onclick="openDecisionModal(this, 'reject')">
                                            Reject
                                        </button>
                                    @else
                                        <a href="#"
                                           style="font-size:0.8rem; color:#fb7185; text-decoration:none;">
                                            View details
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Approve/Reject modal --}}
    <div id="decisionModal" class="modal-backdrop">
        <div class="modal-card fade-in-up">
            <h2 id="decisionTitle" style="font-size:1.2rem; font-weight:800; margin-bottom:0.5rem;">
                Approve booking
            </h2>
            <p style="font-size:0.85rem; color:#9ca3af; margin-bottom:0.75rem;">
                You are about to <span id="decisionAction" style="color:#fb7185;">approve</span>
                booking <span id="decisionBookingId" style="color:#fb7185;"></span>.
                Later this action will update the appointment status and trigger notifications
                in line with FR‑8 and OR‑12 (admin override in emergencies).[file:1]
            </p>

            <div style="margin-bottom:0.75rem;">
                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                    Optional note to customer
                </label>
                <textarea rows="3"
                          style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.5rem 0.8rem; font-size:0.85rem; resize:vertical;"
                          placeholder="Example: Stylist changed due to schedule, or reason for rejection."></textarea>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:0.5rem;">
                <button type="button"
                        class="btn glow-btn"
                        style="background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                        onclick="closeDecisionModal()">
                    Cancel
                </button>
                <button type="button" class="btn btn-pink glow-btn">
                    Confirm (UI only)
                </button>
            </div>
        </div>
    </div>

    <script>
        function openDecisionModal(button, mode) {
            const id = button.getAttribute('data-booking-id');
            document.getElementById('decisionBookingId').textContent = id;

            const title = document.getElementById('decisionTitle');
            const actionSpan = document.getElementById('decisionAction');

            if (mode === 'approve') {
                title.textContent = 'Approve booking';
                actionSpan.textContent = 'approve';
                actionSpan.style.color = '#4ade80';
            } else {
                title.textContent = 'Reject booking';
                actionSpan.textContent = 'reject';
                actionSpan.style.color = '#f97373';
            }

            document.getElementById('decisionModal').classList.add('show');
        }

        function closeDecisionModal() {
            document.getElementById('decisionModal').classList.remove('show');
        }
    </script>
</x-app-layout>
