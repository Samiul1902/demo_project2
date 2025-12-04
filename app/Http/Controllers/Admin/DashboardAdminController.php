<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Staff;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    /**
     * Admin dashboard with key KPIs (FR‑9).[file:1]
     */
    public function index()
    {
        $today = Carbon::today();

        // Booking counts
        $totalBookings = Booking::count();
        $todayBookings = Booking::whereDate('date', $today->toDateString())->count();

        $pendingCount   = Booking::where('status', 'Pending')->count();
        $approvedCount  = Booking::where('status', 'Approved')->count();
        $completedCount = Booking::where('status', 'Completed')->count();

        // Revenue using total_price (FR‑13/FR‑14).[file:1]
        $totalRevenue = Booking::whereIn('status', ['Approved', 'Completed'])
            ->sum('total_price');

        $todayRevenue = Booking::whereIn('status', ['Approved', 'Completed'])
            ->whereDate('date', $today->toDateString())
            ->sum('total_price');

        // Entity counts
        $serviceCount = Service::count();
        $staffCount   = Staff::count();

        // Latest activity: recent bookings (most recent 5)
        $recentBookings = Booking::with('service')
            ->orderByDesc('date')
            ->orderByDesc('time')
            ->take(5)
            ->get();

        return view('admin.dashboard', compact(
            'totalBookings',
            'todayBookings',
            'pendingCount',
            'approvedCount',
            'completedCount',
            'totalRevenue',
            'todayRevenue',
            'serviceCount',
            'staffCount',
            'recentBookings'
        ));
    }
}
