<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Feedback &amp; reviews
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.6rem;">
                Share your experience about completed appointments. Later, these reviews
                will be stored and shown on service pages as required by FR‑7.[file:1]
            </p>

            @php
                $completedBookings = [
                    [
                        'id' => 'SSB-2025-002',
                        'service' => 'Facial Treatment',
                        'staff' => 'Ayesha',
                        'date' => '02 Dec 2025',
                        'branch' => 'Dhanmondi Branch',
                    ],
                    [
                        'id' => 'SSB-2025-003',
                        'service' => 'Hair Spa',
                        'staff' => 'Fahim',
                        'date' => '28 Nov 2025',
                        'branch' => 'Banani Branch',
                    ],
                ];
            @endphp

            {{-- Pending feedback list --}}
            <h2 style="font-size:1.1rem; font-weight:700; margin-bottom:0.8rem;">
                Pending feedback
            </h2>
            <div style="display:flex; flex-direction:column; gap:0.9rem; margin-bottom:2rem;">
                @forelse($completedBookings as $b)
                    <div class="card">
                        <div style="display:flex; justify-content:space-between; gap:1rem; flex-wrap:wrap;">
                            <div style="flex:1 1 220px;">
                                <p style="font-size:0.8rem; color:#9ca3af; margin:0 0 0.25rem 0;">
                                    Booking ID: <span style="color:#e5e7eb;">{{ $b['id'] }}</span>
                                </p>
                                <p style="font-size:0.95rem; font-weight:600; margin:0 0 0.2rem 0;">
                                    {{ $b['service'] }}
                                </p>
                                <p style="font-size:0.8rem; color:#9ca3af; margin:0 0 0.2rem 0;">
                                    Staff: {{ $b['staff'] }} • {{ $b['branch'] }}
                                </p>
                                <p style="font-size:0.8rem; color:#9ca3af; margin:0;">
                                    Date: {{ $b['date'] }}
                                </p>
                            </div>

                            <div style="display:flex; flex-direction:column; gap:0.4rem; align-items:flex-end; flex:0 0 180px;">
                                <button type="button"
                                        class="btn btn-pink glow-btn"
                                        style="width:100%;"
                                        data-booking-id="{{ $b['id'] }}"
                                        data-service-name="{{ $b['service'] }}"
                                        onclick="openFeedbackModal(this)">
                                    Rate this service
                                </button>
                            </div>
                        </div>
                    </div>
                @empty
                    <p style="font-size:0.85rem; color:#9ca3af;">
                        You have no completed bookings waiting for feedback.
                    </p>
                @endforelse
            </div>

            {{-- Recent reviews preview --}}
            <h2 style="font-size:1.1rem; font-weight:700; margin-bottom:0.8rem;">
                Recent reviews (example)
            </h2>
            <div style="display:flex; flex-direction:column; gap:0.9rem;">
                @for($i = 1; $i <= 3; $i++)
                    <div class="card">
                        <div style="display:flex; gap:0.75rem;">
                            <div style="
                                width:2.2rem; height:2.2rem;
                                border-radius:999px;
                                background:linear-gradient(135deg,#fb7185,#8b5cf6);
                                display:flex; align-items:center; justify-content:center;
                                font-size:0.8rem; font-weight:700;">
                                U{{ $i }}
                            </div>
                            <div style="flex:1 1 0;">
                                <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:0.15rem;">
                                    <span style="font-size:0.9rem; font-weight:600;">Customer {{ $i }}</span>
                                    <span style="color:#facc15; font-size:0.8rem;">★★★★☆</span>
                                </div>
                                <p style="font-size:0.8rem; color:#9ca3af; margin:0 0 0.25rem 0;">
                                    Service: Premium Haircut • Staff: Ayesha • 2 days ago
                                </p>
                                <p style="font-size:0.85rem; color:#e5e7eb; margin:0;">
                                    Excellent service and very friendly staff. Booking online was quick and easy.
                                </p>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </section>

    {{-- Feedback modal --}}
    <div id="feedbackModal" class="modal-backdrop">
        <div class="modal-card fade-in-up">
            <h2 style="font-size:1.2rem; font-weight:800; margin-bottom:0.4rem;">
                Rate your experience
            </h2>
            <p style="font-size:0.85rem; color:#9ca3af; margin-bottom:0.75rem;">
                Booking <span id="feedbackBookingId" style="color:#fb7185;"></span> –
                <span id="feedbackServiceName" style="color:#e5e7eb;"></span>
            </p>

            <div style="margin-bottom:0.75rem;">
                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                    Overall rating
                </label>
                <div class="star-row" id="starRow">
                    <span class="star" data-value="1">★</span>
                    <span class="star" data-value="2">★</span>
                    <span class="star" data-value="3">★</span>
                    <span class="star" data-value="4">★</span>
                    <span class="star" data-value="5">★</span>
                </div>
            </div>

            <div style="margin-bottom:0.75rem;">
                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                    Comments
                </label>
                <textarea rows="3"
                          style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.5rem 0.8rem; font-size:0.85rem; resize:vertical;"
                          placeholder="Tell us what went well or what can be improved."></textarea>
            </div>

            <div style="display:flex; justify-content:flex-end; gap:0.5rem;">
                <button type="button"
                        class="btn glow-btn"
                        style="background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                        onclick="closeFeedbackModal()">
                    Close
                </button>
                <button type="button" class="btn btn-pink glow-btn">
                    Submit feedback (UI)
                </button>
            </div>
        </div>
    </div>

    <script>
        function openFeedbackModal(button) {
            const bookingId = button.getAttribute('data-booking-id');
            const serviceName = button.getAttribute('data-service-name');
            document.getElementById('feedbackBookingId').textContent = bookingId;
            document.getElementById('feedbackServiceName').textContent = serviceName;
            document.getElementById('feedbackModal').classList.add('show');
        }

        function closeFeedbackModal() {
            document.getElementById('feedbackModal').classList.remove('show');
        }

        // Simple star rating interaction (frontend only)
        const starRow = document.getElementById('starRow');
        if (starRow) {
            starRow.addEventListener('click', function (e) {
                if (!e.target.classList.contains('star')) return;
                const value = parseInt(e.target.getAttribute('data-value'), 10);
                const stars = starRow.querySelectorAll('.star');
                stars.forEach(star => {
                    const v = parseInt(star.getAttribute('data-value'), 10);
                    if (v <= value) {
                        star.classList.add('active');
                    } else {
                        star.classList.remove('active');
                    }
                });
            });
        }
    </script>
</x-app-layout>
