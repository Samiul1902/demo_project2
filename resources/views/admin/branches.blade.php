<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Branch management
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                Configure salon branches for multi-location operations, supporting the
                multi-branch requirement (FR‑16).[file:1]
            </p>

            @if(session('status'))
                <div class="card"
                     style="margin-bottom:1rem; font-size:0.85rem; color:#bbf7d0; border-color:rgba(34,197,94,0.4);">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Add new branch --}}
            <div class="card" style="margin-bottom:1.2rem;">
                <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.6rem;">
                    Add new branch
                </h2>
                <form method="POST" action="{{ route('admin.branches.store') }}">
                    @csrf
                    <div class="row" style="gap:0.8rem; margin-bottom:0.6rem;">
                        <div style="flex:1 1 0;">
                            <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                                Name
                            </label>
                            <input type="text" name="name"
                                   style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.6); color:#e5e7eb; padding:0.4rem 0.7rem; font-size:0.85rem;"
                                   placeholder="e.g., Banani Branch" required>
                        </div>
                        <div style="flex:0 0 9rem;">
                            <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                                Code
                            </label>
                            <input type="text" name="code"
                                   style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.6); color:#e5e7eb; padding:0.4rem 0.7rem; font-size:0.85rem;"
                                   placeholder="BANANI" required>
                        </div>
                    </div>
                    <div class="row" style="gap:0.8rem; margin-bottom:0.7rem;">
                        <div style="flex:1 1 0;">
                            <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                                Address
                            </label>
                            <input type="text" name="address"
                                   style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.6); color:#e5e7eb; padding:0.4rem 0.7rem; font-size:0.85rem;">
                        </div>
                        <div style="flex:0 0 12rem;">
                            <label style="display:block; font-size:0.8rem; color:#9ca3af; margin-bottom:0.2rem;">
                                Phone
                            </label>
                            <input type="text" name="phone"
                                   style="width:100%; background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.6); color:#e5e7eb; padding:0.4rem 0.7rem; font-size:0.85rem;">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-pink glow-btn">
                        Create branch
                    </button>
                </form>
            </div>

            {{-- Existing branches --}}
            <div class="card" style="overflow-x:auto;">
                <h2 style="font-size:1rem; font-weight:700; margin-bottom:0.6rem;">
                    Existing branches
                </h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Code</th>
                            <th>Address</th>
                            <th>Phone</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($branches as $b)
                            <tr>
                                <form method="POST" action="{{ route('admin.branches.update', $b) }}">
                                    @csrf
                                    <td>
                                        <input type="text" name="name"
                                               value="{{ $b->name }}"
                                               style="width:100%; background:#020617; border-radius:0.5rem; border:1px solid rgba(148,163,184,0.6); color:#e5e7eb; padding:0.25rem 0.5rem; font-size:0.8rem;">
                                    </td>
                                    <td>
                                        <input type="text" name="code"
                                               value="{{ $b->code }}"
                                               style="width:7rem; background:#020617; border-radius:0.5rem; border:1px solid rgba(148,163,184,0.6); color:#e5e7eb; padding:0.25rem 0.5rem; font-size:0.8rem;">
                                    </td>
                                    <td>
                                        <input type="text" name="address"
                                               value="{{ $b->address }}"
                                               style="width:100%; background:#020617; border-radius:0.5rem; border:1px solid rgba(148,163,184,0.6); color:#e5e7eb; padding:0.25rem 0.5rem; font-size:0.8rem;">
                                    </td>
                                    <td>
                                        <input type="text" name="phone"
                                               value="{{ $b->phone }}"
                                               style="width:9rem; background:#020617; border-radius:0.5rem; border:1px solid rgba(148,163,184,0.6); color:#e5e7eb; padding:0.25rem 0.5rem; font-size:0.8rem;">
                                    </td>
                                    <td>
                                        <select name="is_active"
                                                class="select"
                                                style="width:6.5rem; font-size:0.8rem;">
                                            <option value="1" {{ $b->is_active ? 'selected' : '' }}>Active</option>
                                            <option value="0" {{ !$b->is_active ? 'selected' : '' }}>Inactive</option>
                                        </select>
                                    </td>
                                    <td style="text-align:right;">
                                        <button type="submit"
                                                class="btn glow-btn"
                                                style="padding:0.25rem 0.7rem; font-size:0.8rem;">
                                            Save
                                        </button>
                                    </td>
                                </form>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="font-size:0.85rem; color:#9ca3af; text-align:center;">
                                    No branches defined yet. Use the form above to add your first
                                    salon location and enable multi-branch reporting (FR‑16).[file:1]
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
