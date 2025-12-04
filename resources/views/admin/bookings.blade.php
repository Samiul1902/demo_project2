<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Bookings &amp; approvals
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.2rem;">
                Monitor customer appointments, approve or reject pending bookings, and track
                completed services in line with FR‑9, FR‑12, and FR‑13.[file:1]
            </p>

            {{-- Flash message --}}
            @if(session('status'))
                <div class="card"
                     style="margin-bottom:1rem; font-size:0.85rem; color:#bbf7d0; border-color:rgba(34,197,94,0.4);">
                    {{ session('status') }}
                </div>
            @endif

            {{-- Filters (UI only for now) --}}
            <div style="display:flex; flex-wrap:wrap; gap:0.75rem; margin-bottom:1.2rem; font-size:0.85rem;">
                <select class="select">
                    <option>All statuses</option>
                    <option>Pending</option>
                    <option>Approved</option>
                    <option>Rejected</option>
                    <option>Completed</option>
                </select>
                <select class="select">
                    <option>All branches</option>
                    <option>Banani Branch</option>
                    <option>Dhanmondi Branch</option>
                    <option>Gulshan Branch</option>
                </select>
                <input type="date"
                       class="select"
                       style="background:#020617; border-radius:0.75rem; border:1px solid rgba(148,163,184,0.5); color:#e5e7eb; padding:0.35rem 0.7rem;">
            </div>

            @php
                $statusBadge = function (string $status) {
                    return match ($status) {
                        'Pending'   => 'badge-yellow',
                        'Approved'  => 'badge-green',
                        'Rejected'  => 'badge-red',
                        'Completed' => 'badge-blue',
                        default     => 'badge-gray',
                    };
                };
            @endphp

            <div class="card" style="overflow-x:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Customer</th>
                            <th>Service</th>
                            <th>Branch</th>
                            <th>Date &amp; time</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $b)
                            <tr>
                                <td>#{{ $b->id }}</td>
                                <td>
                                    <div style="font-size:0.85rem; color:#e5e7eb;">
                                        {{ $b->customer_name }}
                                    </div>
                                    @if($b->customer_phone)
                                        <div style="font-size:0.75rem; color:#9ca3af;">
                                            {{ $b->customer_phone }}
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <div style="font-size:0.85rem; color:#e5e7eb;">
                                        {{ $b->service?->name ?? 'Service removed' }}
                                    </div>
                                    <div style="font-size:0.75rem; color:#9ca3af;">
                                        {{ $b->service?->duration }} min • BDT {{ $b->service?->price }}
                                    </div>
                                </td>
                                <td>{{ $b->branch }}</td>
                                <td>
                                    <div style="font-size:0.85rem; color:#e5e7eb;">
                                        {{ \Carbon\Carbon::parse($b->date)->format('d M Y') }}
                                    </div>
                                    <div style="font-size:0.8rem; color:#9ca3af;">
                                        {{ $b->time }}
                                    </div>
                                </td>
                                <td>
                                    <span class="{{ $statusBadge($b->status) }}">
                                        {{ $b->status }}
                                    </span>
                                </td>
                                <td style="text-align:right;">
                                    @if($b->status === 'Pending')
                                        <form action="{{ route('admin.bookings.approve', $b) }}"
                                              method="POST"
                                              style="display:inline-block; margin-right:0.25rem;">
                                            @csrf
                                            <button type="submit"
                                                    class="btn glow-btn"
                                                    style="padding:0.3rem 0.7rem; font-size:0.78rem; background:#16a34a; border-color:#16a34a; color:white;">
                                                Approve
                                            </button>
                                        </form>

                                        <form action="{{ route('admin.bookings.reject', $b) }}"
                                              method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            <button type="submit"
                                                    class="btn glow-btn"
                                                    style="padding:0.3rem 0.7rem; font-size:0.78rem; background:#b91c1c; border-color:#b91c1c; color:white;">
                                                Reject
                                            </button>
                                        </form>
                                    @elseif($b->status === 'Approved')
                                        <form action="{{ route('admin.bookings.complete', $b) }}"
                                              method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            <button type="submit"
                                                    class="btn glow-btn"
                                                    style="padding:0.3rem 0.7rem; font-size:0.78rem; background:#2563eb; border-color:#2563eb; color:white;">
                                                Mark completed
                                            </button>
                                        </form>
                                    @else
                                        <span style="font-size:0.78rem; color:#9ca3af;">
                                            No actions
                                        </span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="font-size:0.85rem; color:#9ca3af; text-align:center;">
                                    No bookings have been created yet. Once customers submit the booking form,
                                    they will appear here for approval.[file:1]
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
