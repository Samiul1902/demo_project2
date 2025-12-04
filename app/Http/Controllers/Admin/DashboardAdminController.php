<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardAdminController extends Controller
{
    /**
     * Admin dashboard with key KPIs (FR‑9).[file:1]
     */
    public function index()
    {
        // Today range in BST-style date only
        $today = Carbon::today();

        // Total counts
        $totalBookings = Booking::count();
        $todayBookings = Booking::whereDate('date', $today->toDateString())->count();

        $pendingCount   = Booking::where('status', 'Pending')->count();
        $approvedCount  = Booking::where('status', 'Approved')->count();
        $completedCount = Booking::where('status', 'Completed')->count();

        // Revenue (using total_price from bookings table)
        $totalRevenue = Booking::whereIn('status', ['Approved', 'Completed'])
            ->sum('total_price');

        $todayRevenue = Booking::whereIn('status', ['Approved', 'Completed'])
            ->whereDate('date', $today->toDateString())
            ->sum('total_price');

        // Simple “top services” for last 30 days
        $thirtyDaysAgo = Carbon::now()->subDays(30)->startOfDay();

        $topServices = Booking::whereIn('status', ['Approved', 'Completed'])
            ->whereDate('date', '>=', $thirtyDaysAgo->toDateString())
            ->select('service_id', DB::raw('COUNT(*) as count'), DB::raw('SUM(total_price) as revenue'))
            ->groupBy('service_id')
            ->orderByDesc('count')
            ->with('service')
            ->take(5)
            ->get();

        // Basic counts for services and staff
        $serviceCount = Service::count();
        $staffCount   = Staff::count();

        return view('admin.dashboard', compact(
            'totalBookings',
            'todayBookings',
            'pendingCount',
            'approvedCount',
            'completedCount',
            'totalRevenue',
            'todayRevenue',
            'topServices',
            'serviceCount',
            'staffCount'
        ));
    }
}
