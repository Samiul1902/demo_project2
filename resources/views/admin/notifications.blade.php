<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Notification log
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                Records of SMS/Email-style notifications generated for bookings, demonstrating
                booking confirmations and updates as required by FR‑8.[file:1]
            </p>

            <div class="card" style="overflow-x:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Time</th>
                            <th>Type</th>
                            <th>Channel</th>
                            <th>Recipient</th>
                            <th>Booking</th>
                            <th>Message</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($notifications as $n)
                            <tr>
                                <td style="font-size:0.85rem; color:#e5e7eb;">
                                    {{ $n->created_at->format('d M Y H:i') }}
                                </td>
                                <td style="font-size:0.85rem;">
                                    {{ $n->type }}
                                </td>
                                <td style="font-size:0.85rem;">
                                    {{ $n->channel }}
                                </td>
                                <td style="font-size:0.85rem;">
                                    {{ $n->recipient ?? 'N/A' }}
                                </td>
                                <td style="font-size:0.85rem;">
                                    @if($n->booking)
                                        #{{ $n->booking->id }}
                                    @else
                                        <span style="color:#9ca3af; font-size:0.8rem;">None</span>
                                    @endif
                                </td>
                                <td style="font-size:0.85rem; max-width:320px;">
                                    {{ $n->message }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="font-size:0.85rem; color:#9ca3af; text-align:center;">
                                    No notifications have been logged yet. Once customers book, cancel,
                                    and admins approve/reject bookings, entries will appear here.[file:1]
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(method_exists($notifications, 'links'))
                <div style="margin-top:1rem;">
                    {{ $notifications->links() }}
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
