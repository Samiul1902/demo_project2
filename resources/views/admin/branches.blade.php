<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Branches &amp; locations
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.6rem;">
                Manage salon branches for multi‑branch operations. Later these records will
                link to services, staff, and bookings to fulfil FR‑16.[file:1]
            </p>

            {{-- Top bar --}}
            <div style="display:flex; justify-content:space-between; gap:1rem; flex-wrap:wrap; margin-bottom:1rem;">
                <div style="flex:1 1 220px;">
                    <input type="text"
                           placeholder="Search branches..."
                           style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                </div>
                <button type="button" class="btn btn-pink glow-btn" onclick="openBranchModal('add')">
                    + Add branch
                </button>
            </div>

            @php
                $branches = [
                    ['name' => 'Banani Branch',    'address' => 'Banani, Dhaka',    'phone' => '+8801XXXXXXXX1', 'hours' => '10:00–20:00', 'status' => 'Active'],
                    ['name' => 'Dhanmondi Branch', 'address' => 'Dhanmondi, Dhaka', 'phone' => '+8801XXXXXXXX2', 'hours' => '10:00–21:00', 'status' => 'Active'],
                    ['name' => 'Gulshan Branch',   'address' => 'Gulshan, Dhaka',   'phone' => '+8801XXXXXXXX3', 'hours' => '11:00–20:00', 'status' => 'Planned'],
                ];
            @endphp

            <div class="card">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Branch</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Hours</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($branches as $br)
                            @php
                                $statusClass = $br['status'] === 'Active' ? 'badge-green' : 'badge-pink';
                            @endphp
                            <tr>
                                <td>{{ $br['name'] }}</td>
                                <td>{{ $br['address'] }}</td>
                                <td>{{ $br['phone'] }}</td>
                                <td>{{ $br['hours'] }}</td>
                                <td>
                                    <span class="{{ $statusClass }}">{{ $br['status'] }}</span>
                                </td>
                                <td style="text-align:right;">
                                    <button type="button"
                                            class="btn glow-btn"
                                            style="padding:0.3rem 0.7rem; font-size:0.8rem; background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                                            data-branch-name="{{ $br['name'] }}"
                                            onclick="openBranchModal('edit', this)">
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

    {{-- Add/Edit branch modal --}}
    <div id="branchModal" class="modal-backdrop">
        <div class="modal-card fade-in-up">
            <h2 id="branchModalTitle" style="font-size:1.2rem; font-weight:800; margin-bottom:0.6rem;">
                Add branch
            </h2>

            <form>
                <div style="margin-bottom:0.7rem;">
                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                        Branch name *
                    </label>
                    <input type="text"
                           id="branchNameInput"
                           style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                </div>

                <div style="margin-bottom:0.7rem;">
                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                        Address *
                    </label>
                    <input type="text"
                           style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                </div>

                <div class="row" style="gap:0.7rem; margin-bottom:0.7rem;">
                    <div style="flex:1 1 0;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Phone *
                        </label>
                        <input type="text"
                               style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                    </div>
                    <div style="flex:1 1 0;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Hours *
                        </label>
                        <input type="text"
                               placeholder="e.g., 10:00–20:00"
                               style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                    </div>
                </div>

                <div style="margin-bottom:0.7rem;">
                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                        Status
                    </label>
                    <select class="select" style="width:100%;">
                        <option>Active</option>
                        <option>Planned</option>
                        <option>Closed</option>
                    </select>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:0.5rem;">
                    <button type="button"
                            class="btn glow-btn"
                            style="background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                            onclick="closeBranchModal()">
                        Cancel
                    </button>
                    <button type="button" class="btn btn-pink glow-btn">
                        Save (UI only)
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        function openBranchModal(mode = 'add', button = null) {
            const modal = document.getElementById('branchModal');
            const title = document.getElementById('branchModalTitle');
            const nameInput = document.getElementById('branchNameInput');

            if (mode === 'edit' && button) {
                const branchName = button.getAttribute('data-branch-name') || '';
                title.textContent = 'Edit branch';
                nameInput.value = branchName;
            } else {
                title.textContent = 'Add branch';
                nameInput.value = '';
            }
            modal.classList.add('show');
        }

        function closeBranchModal() {
            document.getElementById('branchModal').classList.remove('show');
        }
    </script>
</x-app-layout>
