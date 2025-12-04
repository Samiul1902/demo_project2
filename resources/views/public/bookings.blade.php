<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                My bookings
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                Review your appointments, manage cancellations, open invoices, and see
                how many loyalty points you earn from each visit.[file:1]
            </p>

            @if(session('status'))
                <div class="card"
                     style="margin-bottom:1rem; font-size:0.85rem; color:#bbf7d0; border-color:rgba(34,197,94,0.4);">
                    {{ session('status') }}
                </div>
            @endif

            @php
                $statusBadge = function (string $status) {
                    return match ($status) {
                        'Pending'   => 'badge-yellow',
                        'Approved'  => 'badge-green',
                        'Rejected'  => 'badge-red',
                        'Completed' => 'badge-blue',
                        'Cancelled' => 'badge-gray',
                        default     => 'badge-gray',
                    };
                };
            @endphp

            <div class="card" style="overflow-x:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Service</th>
                            <th>Branch</th>
                            <th>Date &amp; time</th>
                            <th>Points</th>
                            <th>Status</th>
                            <th style="text-align:right;">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($bookings as $b)
                            @php
                                $dt = \Carbon\Carbon::parse($b->date.' '.$b->time);
                                $canCancel = in_array($b->status, ['Pending','Approved']) && $dt->isFuture();
                            @endphp
                            <tr>
                                <td>#{{ $b->id }}</td>
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
                                        {{ $dt->format('d M Y') }}
                                    </div>
                                    <div style="font-size:0.8rem; color:#9ca3af;">
                                        {{ $dt->format('h:i A') }}
                                    </div>
                                </td>
                                <td style="font-size:0.85rem; color:#4ade80;">
                                    {{ $b->loyalty_points }}
                                </td>
                                <td>
                                    <span class="{{ $statusBadge($b->status) }}">
                                        {{ $b->status }}
                                    </span>
                                </td>
                                <td style="text-align:right;">
                                    @if(in_array($b->status, ['Approved','Completed']))
                                        <a href="{{ route('public.bookings.invoice', $b) }}"
                                           class="btn glow-btn"
                                           style="padding:0.25rem 0.7rem; font-size:0.8rem; background:transparent; border-color:rgba(148,163,184,0.6); color:#e5e7eb; margin-right:0.25rem;">
                                            View invoice
                                        </a>
                                    @endif

                                    @if($canCancel)
                                        <form action="{{ route('public.bookings.cancel', $b) }}"
                                              method="POST"
                                              style="display:inline-block;">
                                            @csrf
                                            <button type="submit"
                                                    class="btn glow-btn"
                                                    style="padding:0.25rem 0.7rem; font-size:0.8rem; background:#b91c1c; border-color:#b91c1c; color:#fff;">
                                                Cancel
                                            </button>
                                        </form>
                                    @else
                                        @if(!in_array($b->status, ['Approved','Completed']))
                                            <span style="font-size:0.78rem; color:#9ca3af;">
                                                No actions
                                            </span>
                                        @endif
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="7" style="font-size:0.85rem; color:#9ca3af; text-align:center;">
                                    You do not have any bookings yet. Once you confirm an appointment,
                                    it will appear here with its status, invoice link, and loyalty points.[file:1]
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</x-app-layout>
