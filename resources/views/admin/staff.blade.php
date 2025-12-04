<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Staff &amp; schedules
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                View team members across branches and adjust their working hours and weekly
                off-day, implementing staff schedule management (FR‑11).[file:1]
            </p>

            @if(session('status'))
                <div class="card"
                     style="margin-bottom:1rem; font-size:0.85rem; color:#bbf7d0; border-color:rgba(34,197,94,0.4);">
                    {{ session('status') }}
                </div>
            @endif

            <div class="card" style="overflow-x:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Role</th>
                            <th>Branch</th>
                            <th>Shift start</th>
                            <th>Shift end</th>
                            <th>Weekly off</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($staff as $member)
                            <tr>
                                <td>{{ $member->name }}</td>
                                <td>{{ $member->role }}</td>
                                <td>{{ $member->branch }}</td>

                                <td>
                                    <form method="POST"
                                          action="{{ route('admin.staff.schedule', $member) }}">
                                        @csrf
                                        <input type="text"
                                               name="shift_start"
                                               value="{{ old('shift_start', $member->shift_start ?? '10:00 AM') }}"
                                               style="width:6rem; background:#020617; border-radius:0.5rem; border:1px solid rgba(148,163,184,0.6); color:#e5e7eb; padding:0.2rem 0.5rem; font-size:0.8rem;">
                                </td>
                                <td>
                                        <input type="text"
                                               name="shift_end"
                                               value="{{ old('shift_end', $member->shift_end ?? '08:00 PM') }}"
                                               style="width:6rem; background:#020617; border-radius:0.5rem; border:1px solid rgba(148,163,184,0.6); color:#e5e7eb; padding:0.2rem 0.5rem; font-size:0.8rem;">
                                </td>
                                <td>
                                        <input type="text"
                                               name="weekly_off"
                                               value="{{ old('weekly_off', $member->weekly_off ?? 'Friday') }}"
                                               style="width:6.5rem; background:#020617; border-radius:0.5rem; border:1px solid rgba(148,163,184,0.6); color:#e5e7eb; padding:0.2rem 0.5rem; font-size:0.8rem;">
                                </td>
                                <td>
                                        <select name="status"
                                                class="select"
                                                style="width:6.5rem; font-size:0.8rem;">
                                            <option value="Active" {{ $member->status === 'Active' ? 'selected' : '' }}>
                                                Active
                                            </option>
                                            <option value="Inactive" {{ $member->status === 'Inactive' ? 'selected' : '' }}>
                                                Inactive
                                            </option>
                                        </select>
                                </td>
                                <td style="text-align:right;">
                                        <button type="submit"
                                                class="btn glow-btn"
                                                style="padding:0.25rem 0.7rem; font-size:0.8rem;">
                                            Save
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="8" style="font-size:0.85rem; color:#9ca3af; text-align:center;">
                                    No staff members have been added yet. Once staff records exist,
                                    you can use this screen to configure their working hours and
                                    weekly off-day per FR‑11.[file:1]
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
