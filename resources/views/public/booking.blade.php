<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.8rem; font-weight:800; margin-bottom:0.4rem;">
                Book an appointment
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.8rem;">
                Choose your service, branch, stylist, date and time to confirm your booking.
                Later this form will be connected to real appointments and invoices as required
                in the SRS.[file:1]
            </p>

            <div class="row" style="gap:2rem;">
                {{-- Left: booking form --}}
                <div class="col-half">
                    <div class="card">
                        <form id="bookingForm">
                            {{-- Service --}}
                            <div style="margin-bottom:0.9rem;">
                                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                    Service *
                                </label>
                                <select class="select" style="width:100%;" id="serviceSelect">
                                    <option value="Premium Haircut" data-price="800" data-duration="45">
                                        Premium Haircut – BDT 800 (45 min)
                                    </option>
                                    <option value="Facial Treatment" data-price="1200" data-duration="60">
                                        Facial Treatment – BDT 1200 (60 min)
                                    </option>
                                    <option value="Bridal Makeup" data-price="5000" data-duration="120">
                                        Bridal Makeup – BDT 5000 (120 min)
                                    </option>
                                    <option value="Hair Spa" data-price="1500" data-duration="90">
                                        Hair Spa – BDT 1500 (90 min)
                                    </option>
                                </select>
                            </div>

                            {{-- Branch --}}
                            <div style="margin-bottom:0.9rem;">
                                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                    Branch *
                                </label>
                                <select class="select" style="width:100%;" id="branchSelect">
                                    <option>Banani Branch</option>
                                    <option>Dhanmondi Branch</option>
                                    <option>Gulshan Branch</option>
                                </select>
                            </div>

                            {{-- Stylist --}}
                            <div style="margin-bottom:0.9rem;">
                                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                    Stylist preference
                                </label>
                                <select class="select" style="width:100%;" id="stylistSelect">
                                    <option>Any available stylist</option>
                                    <option>Ayesha (4.8★)</option>
                                    <option>Fahim (4.6★)</option>
                                    <option>Nadia (4.9★)</option>
                                </select>
                            </div>

                            {{-- Date & Time --}}
                            <div class="row" style="gap:0.9rem; margin-bottom:0.9rem;">
                                <div style="flex:1 1 0;">
                                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                        Date *
                                    </label>
                                    <input type="date"
                                           id="dateInput"
                                           style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                                </div>
                                <div style="flex:1 1 0;">
                                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                        Time *
                                    </label>
                                    <select class="select" style="width:100%;" id="timeSelect">
                                        <option>10:00 AM</option>
                                        <option>11:30 AM</option>
                                        <option>3:30 PM</option>
                                        <option>4:15 PM</option>
                                        <option>5:00 PM</option>
                                    </select>
                                </div>
                            </div>

                            {{-- Notes --}}
                            <div style="margin-bottom:1rem;">
                                <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.25rem;">
                                    Special requests (optional)
                                </label>
                                <textarea id="notesInput"
                                          rows="3"
                                          style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.55rem 0.8rem; font-size:0.85rem; resize:vertical;"
                                          placeholder="Any specific preferences or instructions?"></textarea>
                            </div>

                            <button type="button"
                                    class="btn btn-pink glow-btn"
                                    style="width:100%; margin-top:0.25rem;"
                                    onclick="openConfirmation()">
                                Confirm booking (UI only)
                            </button>
                        </form>
                    </div>
                </div>

                {{-- Right: summary --}}
                <div class="col-half">
                    <div class="card" id="summaryCard">
                        <h2 style="font-size:1.1rem; font-weight:700; margin-bottom:0.9rem;">
                            Booking summary
                        </h2>

                        <div style="font-size:0.9rem; margin-bottom:0.25rem; display:flex; justify-content:space-between;">
                            <span>Service</span>
                            <span id="summaryService">Premium Haircut</span>
                        </div>
                        <div style="font-size:0.9rem; margin-bottom:0.25rem; display:flex; justify-content:space-between;">
                            <span>Duration</span>
                            <span id="summaryDuration">45 min</span>
                        </div>
                        <div style="font-size:0.9rem; margin-bottom:0.25rem; display:flex; justify-content:space-between;">
                            <span>Branch</span>
                            <span id="summaryBranch">Banani Branch</span>
                        </div>
                        <div style="font-size:0.9rem; margin-bottom:0.25rem; display:flex; justify-content:space-between;">
                            <span>Date</span>
                            <span id="summaryDate">Not selected</span>
                        </div>
                        <div style="font-size:0.9rem; margin-bottom:0.6rem; display:flex; justify-content:space-between;">
                            <span>Time</span>
                            <span id="summaryTime">10:00 AM</span>
                        </div>

                        <hr style="border-color:rgba(148,163,184,0.25); margin:0.9rem 0;">

                        <div style="font-size:0.9rem; margin-bottom:0.25rem; display:flex; justify-content:space-between;">
                            <span>Service price</span>
                            <span id="summaryPrice">BDT 800</span>
                        </div>
                        <div style="font-size:0.85rem; color:#22c55e; margin-bottom:0.25rem; display:flex; justify-content:space-between;">
                            <span>Estimated loyalty discount</span>
                            <span>- BDT 50</span>
                        </div>
                        <div style="font-size:1rem; font-weight:700; display:flex; justify-content:space-between; margin-top:0.15rem;">
                            <span>Total</span>
                            <span id="summaryTotal" style="color:#fb7185;">BDT 750</span>
                        </div>

                        <p style="font-size:0.8rem; color:#9ca3af; margin-top:0.75rem;">
                            You will earn <span style="color:#4ade80; font-weight:600;">75 loyalty points</span> for this booking, 
                            which can be used in the membership system defined in the requirements.[file:1]
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Confirmation modal --}}
    <div id="confirmationModal" class="modal-backdrop">
        <div class="modal-card fade-in-up">
            <div style="width:3rem; height:3rem; border-radius:999px; background:rgba(34,197,94,0.18); display:flex; align-items:center; justify-content:center; margin:0 auto 0.75rem auto;">
                <span style="font-size:1.6rem; color:#4ade80;">✓</span>
            </div>
            <h2 style="font-size:1.4rem; font-weight:800; text-align:center; margin-bottom:0.4rem;">
                Booking confirmed (demo)
            </h2>
            <p style="font-size:0.85rem; color:#9ca3af; text-align:center; margin-bottom:0.9rem;">
                In the final system, this step will generate a digital invoice and send SMS/Email 
                confirmation according to FR‑4 and FR‑8.[file:1]
            </p>

            <div class="card" style="font-size:0.85rem; margin-bottom:0.9rem;">
                <div style="display:flex; justify-content:space-between; margin-bottom:0.25rem;">
                    <span>Service</span><span id="modalService">Premium Haircut</span>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom:0.25rem;">
                    <span>Date &amp; time</span><span id="modalDateTime">–</span>
                </div>
                <div style="display:flex; justify-content:space-between; margin-bottom:0.25rem;">
                    <span>Branch</span><span id="modalBranch">–</span>
                </div>
                <div style="display:flex; justify-content:space-between;">
                    <span>Amount</span><span id="modalAmount">BDT 750</span>
                </div>
            </div>

            <div style="display:flex; gap:0.5rem; justify-content:center;">
                <a href="{{ route('public.bookings') }}" class="btn btn-pink glow-btn" style="flex:1; text-align:center;">
                    Go to My Bookings
                </a>
                <button type="button" class="btn glow-btn"
                        style="flex:1; background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                        onclick="closeConfirmation()">
                    Close
                </button>
            </div>
        </div>
    </div>

    <script>
        const serviceSelect = document.getElementById('serviceSelect');
        const branchSelect = document.getElementById('branchSelect');
        const dateInput = document.getElementById('dateInput');
        const timeSelect = document.getElementById('timeSelect');

        function updateSummary() {
            const selected = serviceSelect.options[serviceSelect.selectedIndex];
            const name = selected.value;
            const price = selected.getAttribute('data-price');
            const duration = selected.getAttribute('data-duration');

            document.getElementById('summaryService').textContent = name;
            document.getElementById('summaryDuration').textContent = duration + ' min';
            document.getElementById('summaryPrice').textContent = 'BDT ' + price;
            document.getElementById('summaryTotal').textContent = 'BDT ' + (price - 50);
            document.getElementById('summaryBranch').textContent = branchSelect.value;

            document.getElementById('summaryDate').textContent = dateInput.value || 'Not selected';
            document.getElementById('summaryTime').textContent = timeSelect.value;

            // also prepare modal
            document.getElementById('modalService').textContent = name;
            document.getElementById('modalBranch').textContent = branchSelect.value;
            document.getElementById('modalAmount').textContent = 'BDT ' + (price - 50);
            document.getElementById('modalDateTime').textContent =
                (dateInput.value || 'Not selected') + ' at ' + timeSelect.value;
        }

        serviceSelect.addEventListener('change', updateSummary);
        branchSelect.addEventListener('change', updateSummary);
        dateInput.addEventListener('change', updateSummary);
        timeSelect.addEventListener('change', updateSummary);

        function openConfirmation() {
            updateSummary();
            document.getElementById('confirmationModal').classList.add('show');
        }

        function closeConfirmation() {
            document.getElementById('confirmationModal').classList.remove('show');
        }

        // initialize once
        updateSummary();
    </script>
</x-app-layout>
