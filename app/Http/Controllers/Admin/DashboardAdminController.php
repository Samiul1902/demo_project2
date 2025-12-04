<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Branch;
use Illuminate\Support\Facades\DB;

class DashboardAdminController extends Controller
{
    /**
     * Admin dashboard overview (FR‑9).[file:1]
     */
    public function index()
    {
        $today = now()->toDateString();

        $baseToday = Booking::whereDate('date', $today);

        $kpis = [
            'today_bookings'   => (clone $baseToday)->count(),
            'today_revenue'    => (clone $baseToday)
                ->whereIn('status', ['Completed', 'Approved'])
                ->sum('total_price'),
            'pending_bookings' => Booking::where('status', 'Pending')->count(),
            'active_branches'  => Branch::where('is_active', true)->count(),
        ];

        // Top services by count for current month (FR‑14 insight).[file:1]
        $topServices = Booking::select(
                'service_id',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()])
            ->whereIn('status', ['Completed', 'Approved'])
            ->groupBy('service_id')
            ->with('service')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        // Today by branch.[file:1]
        $byBranchToday = (clone $baseToday)
            ->select(
                'branch',
                DB::raw('COUNT(*) as count'),
                DB::raw('SUM(total_price) as revenue')
            )
            ->groupBy('branch')
            ->orderByDesc('revenue')
            ->get();

        // Recent bookings list.
        $recentBookings = Booking::with('service')
            ->orderByDesc('date')
            ->orderByDesc('time')
            ->limit(10)
            ->get();

        return view('admin.dashboard', [
            'kpis'           => $kpis,
            'topServices'    => $topServices,
            'byBranchToday'  => $byBranchToday,
            'recentBookings' => $recentBookings,
        ]);
    }
}
