<x-app-layout>
    <section style="padding: 2.5rem 0 3rem 0;">
        <div class="container fade-in-up">
            <h1 style="font-size:1.6rem; font-weight:800; margin-bottom:0.4rem;">
                Customer feedback
            </h1>
            <p style="font-size:0.9rem; color:#9ca3af; margin-bottom:1.4rem;">
                Reviews and comments submitted by customers about services, staff, or overall
                experience, implementing the feedback feature (FR‑7) on the admin side.[file:1]
            </p>

            <div class="card" style="overflow-x:auto;">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Customer</th>
                            <th>Target</th>
                            <th>Rating</th>
                            <th>Comments</th>
                            <th>Booking</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($feedback as $f)
                            <tr>
                                <td style="font-size:0.85rem; color:#e5e7eb;">
                                    {{ $f->created_at->format('d M Y') }}
                                </td>
                                <td style="font-size:0.85rem;">
                                    <div style="color:#e5e7eb;">{{ $f->customer_name }}</div>
                                    @if($f->customer_phone)
                                        <div style="color:#9ca3af; font-size:0.75rem;">
                                            {{ $f->customer_phone }}
                                        </div>
                                    @endif
                                </td>
                                <td style="font-size:0.85rem;">
                                    <div style="color:#e5e7eb; text-transform:capitalize;">
                                        {{ $f->target_type }}
                                    </div>
                                    @if($f->target_name)
                                        <div style="color:#9ca3af; font-size:0.75rem;">
                                            {{ $f->target_name }}
                                        </div>
                                    @endif
                                </td>
                                <td style="font-size:0.85rem;">
                                    @if($f->rating)
                                        {{ $f->rating }} ★
                                    @else
                                        <span style="color:#9ca3af; font-size:0.8rem;">No rating</span>
                                    @endif
                                </td>
                                <td style="font-size:0.85rem; max-width:280px;">
                                    @if($f->comments)
                                        <span style="color:#e5e7eb;">
                                            {{ \Illuminate\Support\Str::limit($f->comments, 120) }}
                                        </span>
                                    @else
                                        <span style="color:#9ca3af; font-size:0.8rem;">No comments</span>
                                    @endif
                                </td>
                                <td style="font-size:0.85rem;">
                                    @if($f->booking)
                                        <div style="color:#e5e7eb;">
                                            #{{ $f->booking->id }}
                                        </div>
                                        <div style="color:#9ca3af; font-size:0.75rem;">
                                            {{ $f->booking->branch }} • {{ $f->booking->date }}
                                        </div>
                                    @else
                                        <span style="color:#9ca3af; font-size:0.8rem;">Not linked</span>
                                    @endif
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" style="font-size:0.85rem; color:#9ca3af; text-align:center;">
                                    No feedback has been submitted yet. Once customers start using the
                                    feedback form, their reviews will appear here for analysis and
                                    service improvement.[file:1]
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            {{-- Pagination --}}
            @if(method_exists($feedback, 'links'))
                <div style="margin-top:1rem;">
                    {{ $feedback->links() }}
                </div>
            @endif
        </div>
    </section>
</x-app-layout>
