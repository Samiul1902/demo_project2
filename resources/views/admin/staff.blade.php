<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Staff &amp; schedules
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.6rem;">
                Manage stylists, assign them to branches, and configure their weekly
                availability as required by the admin module (FR‑11).[file:1]
            </p>

            {{-- Top bar --}}
            <div style="display:flex; justify-content:space-between; gap:1rem; flex-wrap:wrap; margin-bottom:1rem;">
                <div style="flex:1 1 220px;">
                    <input type="text"
                           placeholder="Search staff..."
                           style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                </div>
                <div style="display:flex; gap:0.5rem;">
                    <select class="select">
                        <option>All branches</option>
                        <option>Banani</option>
                        <option>Dhanmondi</option>
                        <option>Gulshan</option>
                    </select>
                    <button type="button" class="btn btn-pink glow-btn" onclick="openStaffModal('add')">
                        + Add staff
                    </button>
                </div>
            </div>

            {{-- Staff table (static demo data) --}}
            @php
                $staff = [
                    ['name' => 'Ayesha', 'role' => 'Senior Stylist', 'branch' => 'Banani',    'rating' => 4.8, 'status' => 'Active'],
                    ['name' => 'Fahim',  'role' => 'Stylist',        'branch' => 'Dhanmondi', 'rating' => 4.6, 'status' => 'Active'],
                    ['name' => 'Nadia',  'role' => 'Makeup Artist',  'branch' => 'Gulshan',   'rating' => 4.9, 'status' => 'On leave'],
                ];
            @endphp

            <div class="card" style="overflow-x:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Staff</th>
                            <th>Role</th>
                            <th>Branch</th>
                            <th>Rating</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($staff as $st)
                            @php
                                $statusClass = $st['status'] === 'Active' ? 'badge-green' : 'badge-pink';
                            @endphp
                            <tr>
                                <td>{{ $st['name'] }}</td>
                                <td>{{ $st['role'] }}</td>
                                <td>{{ $st['branch'] }}</td>
                                <td>{{ $st['rating'] }}★</td>
                                <td>
                                    <span class="{{ $statusClass }}">{{ $st['status'] }}</span>
                                </td>
                                <td style="text-align:right;">
                                    <button type="button"
                                            class="btn glow-btn"
                                            style="padding:0.3rem 0.7rem; font-size:0.8rem; background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                                            data-staff-name="{{ $st['name'] }}"
                                            onclick="openScheduleModal(this)">
                                        Edit schedule
                                    </button>
                                    <button type="button"
                                            class="btn btn-pink glow-btn"
                                            style="padding:0.3rem 0.7rem; font-size:0.8rem;">
                                        Edit
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Add/Edit staff modal --}}
    <div id="staffModal" class="modal-backdrop">
        <div class="modal-card fade-in-up">
            <h2 id="staffModalTitle" style="font-size:1.2rem; font-weight:800; margin-bottom:0.6rem;">
                Add staff
            </h2>

            <form>
                <div style="margin-bottom:0.7rem;">
                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                        Full name *
                    </label>
                    <input type="text"
                           style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                </div>

                <div style="margin-bottom:0.7rem;">
                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                        Role *
                    </label>
                    <input type="text"
                           placeholder="e.g., Senior Stylist"
                           style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                </div>

                <div class="row" style="gap:0.7rem; margin-bottom:0.7rem;">
                    <div style="flex:1 1 0;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Branch *
                        </label>
                        <select class="select" style="width:100%;">
                            <option>Banani</option>
                            <option>Dhanmondi</option>
                            <option>Gulshan</option>
                        </select>
                    </div>
                    <div style="flex:1 1 0;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Status
                        </label>
                        <select class="select" style="width:100%;">
                            <option>Active</option>
                            <option>On leave</option>
                        </select>
                    </div>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:0.5rem;">
                    <button type="button"
                            class="btn glow-btn"
                            style="background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                            onclick="closeStaffModal()">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-pink glow-btn">
                        Save (UI only)
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Weekly schedule modal --}}
    <div id="scheduleModal" class="modal-backdrop">
        <div class="modal-card fade-in-up">
            <h2 style="font-size:1.2rem; font-weight:800; margin-bottom:0.4rem;">
                Weekly schedule – <span id="scheduleStaffName" style="color:#fb7185;"></span>
            </h2>
            <p style="font-size:0.8rem; color:#9ca3af; margin-bottom:0.7rem;">
                Define working hours for each day. Later this data will be used to generate
                available time slots for bookings (FR‑3 and FR‑11).[file:1]
            </p>

            @php
                $days = ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'];
            @endphp

            <div style="display:flex; flex-direction:column; gap:0.5rem; margin-bottom:0.8rem;">
                @foreach($days as $day)
                    <div style="display:flex; gap:0.5rem; align-items:center;">
                        <span style="flex:0 0 80px; font-size:0.8rem; color:#e5e7eb;">{{ $day }}</span>
                        <select class="select" style="flex:0 0 90px;">
                            <option>Working</option>
                            <option>Off</option>
                        </select>
                        <input type="time"
                               value="10:00"
                               style="flex:1 1 0; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.3rem 0.6rem; font-size:0.8rem;">
                        <input type="time"
                               value="20:00"
                               style="flex:1 1 0; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.3rem 0.6rem; font-size:0.8rem;">
                    </div>
                @endforeach
            </div>

            <div style="display:flex; justify-content:flex-end; gap:0.5rem;">
                <button type="button"
                        class="btn glow-btn"
                        style="background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                        onclick="closeScheduleModal()">
                    Close
                </button>
                <button type="button" class="btn btn-pink glow-btn">
                    Save schedule (UI)
                </button>
            </div>
        </div>
    </div>

    <script>
        function openStaffModal(mode = 'add') {
            const modal = document.getElementById('staffModal');
            const title = document.getElementById('staffModalTitle');

            if (mode === 'edit') {
                title.textContent = 'Edit staff';
            } else {
                title.textContent = 'Add staff';
            }

            modal.classList.add('show');
        }

        function closeStaffModal() {
            document.getElementById('staffModal').classList.remove('show');
        }

        function openScheduleModal(button) {
            const name = button.getAttribute('data-staff-name') || '';
            document.getElementById('scheduleStaffName').textContent = name;
            document.getElementById('scheduleModal').classList.add('show');
        }

        function closeScheduleModal() {
            document.getElementById('scheduleModal').classList.remove('show');
        }
    </script>
</x-app-layout>
