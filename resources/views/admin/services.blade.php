<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Manage services
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.6rem;">
                Add, edit, or disable services and pricing for each branch. This page
                corresponds to the admin service management requirement (FR‑10).[file:1]
            </p>

            {{-- Top bar: search + add button --}}
            <div style="display:flex; justify-content:space-between; gap:1rem; flex-wrap:wrap; margin-bottom:1rem;">
                <div style="flex:1 1 220px;">
                    <input type="text"
                           placeholder="Search services..."
                           style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                </div>
                <div style="display:flex; gap:0.5rem;">
                    <select class="select">
                        <option>All branches</option>
                        <option>Banani</option>
                        <option>Dhanmondi</option>
                        <option>Gulshan</option>
                    </select>
                    <button type="button" class="btn btn-pink glow-btn" onclick="openServiceModal('add')">
                        + Add service
                    </button>
                </div>
            </div>

            {{-- Services table (static data for now) --}}
            @php
                $services = [
                    ['name' => 'Premium Haircut', 'category' => 'Hair',   'duration' => 45,  'price' => 800,  'branch' => 'Banani',    'status' => 'Active'],
                    ['name' => 'Facial Treatment', 'category' => 'Skin',  'duration' => 60,  'price' => 1200, 'branch' => 'Dhanmondi', 'status' => 'Active'],
                    ['name' => 'Bridal Makeup',    'category' => 'Makeup','duration' => 120, 'price' => 5000, 'branch' => 'Gulshan',   'status' => 'Inactive'],
                ];
            @endphp

            <div class="card" style="overflow-x:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Service</th>
                            <th>Category</th>
                            <th>Duration</th>
                            <th>Price (BDT)</th>
                            <th>Branch</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($services as $s)
                            @php
                                $statusClass = $s['status'] === 'Active' ? 'badge-green' : 'badge-pink';
                            @endphp
                            <tr>
                                <td>{{ $s['name'] }}</td>
                                <td>{{ $s['category'] }}</td>
                                <td>{{ $s['duration'] }} min</td>
                                <td>{{ $s['price'] }}</td>
                                <td>{{ $s['branch'] }}</td>
                                <td>
                                    <span class="{{ $statusClass }}">
                                        {{ $s['status'] }}
                                    </span>
                                </td>
                                <td style="text-align:right;">
                                    <button type="button"
                                            class="btn glow-btn"
                                            style="padding:0.3rem 0.7rem; font-size:0.8rem; background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                                            data-service-name="{{ $s['name'] }}"
                                            onclick="openServiceModal('edit', this)">
                                        Edit
                                    </button>
                                    <button type="button"
                                            class="btn btn-pink glow-btn"
                                            style="padding:0.3rem 0.7rem; font-size:0.8rem; background:#b91c1c; border-color:#b91c1c;">
                                        Disable
                                    </button>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    {{-- Add/Edit service modal --}}
    <div id="serviceModal" class="modal-backdrop">
        <div class="modal-card fade-in-up">
            <h2 id="serviceModalTitle" style="font-size:1.2rem; font-weight:800; margin-bottom:0.6rem;">
                Add service
            </h2>

            <form>
                <div style="margin-bottom:0.7rem;">
                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                        Service name *
                    </label>
                    <input type="text"
                           id="serviceNameInput"
                           style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                </div>

                <div style="margin-bottom:0.7rem;">
                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                        Category *
                    </label>
                    <select class="select" style="width:100%;">
                        <option>Hair</option>
                        <option>Skin</option>
                        <option>Makeup</option>
                        <option>Spa</option>
                    </select>
                </div>

                <div class="row" style="gap:0.7rem; margin-bottom:0.7rem;">
                    <div style="flex:1 1 0;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Duration (min) *
                        </label>
                        <input type="number"
                               min="10"
                               value="45"
                               style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                    </div>
                    <div style="flex:1 1 0;">
                        <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                            Price (BDT) *
                        </label>
                        <input type="number"
                               min="0"
                               value="800"
                               style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.45rem 0.8rem; font-size:0.85rem;">
                    </div>
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
                            <option>Inactive</option>
                        </select>
                    </div>
                </div>

                <div style="margin-bottom:0.7rem;">
                    <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                        Description
                    </label>
                    <textarea rows="3"
                              style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.5rem 0.8rem; font-size:0.85rem; resize:vertical;"
                              placeholder="Short description shown on the service page."></textarea>
                </div>

                <div style="display:flex; justify-content:flex-end; gap:0.5rem;">
                    <button type="button"
                            class="btn glow-btn"
                            style="background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb;"
                            onclick="closeServiceModal()">
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
        function openServiceModal(mode = 'add', button = null) {
            const modal = document.getElementById('serviceModal');
            const title = document.getElementById('serviceModalTitle');
            const nameInput = document.getElementById('serviceNameInput');

            if (mode === 'edit' && button) {
                const serviceName = button.getAttribute('data-service-name') || '';
                title.textContent = 'Edit service';
                nameInput.value = serviceName;
            } else {
                title.textContent = 'Add service';
                nameInput.value = '';
            }

            modal.classList.add('show');
        }

        function closeServiceModal() {
            document.getElementById('serviceModal').classList.remove('show');
        }
    </script>
</x-app-layout>
