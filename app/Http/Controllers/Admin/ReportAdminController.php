<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ReportAdminController extends Controller
{
    /**
     * Basic revenue and booking reports (FR‑14).[file:1]
     */
    public function index()
    {
        // Overall metrics
        $totalRevenue = Booking::whereIn('status', ['Approved', 'Completed'])
            ->sum('total_price');

        $totalBookings = Booking::count();
        $pendingCount  = Booking::where('status', 'Pending')->count();
        $approvedCount = Booking::where('status', 'Approved')->count();
        $completedCount= Booking::where('status', 'Completed')->count();
        $cancelledCount= Booking::where('status', 'Cancelled')->count();

        // Revenue by branch
        $revenueByBranch = Booking::whereIn('status', ['Approved', 'Completed'])
            ->select('branch', DB::raw('SUM(total_price) as revenue'), DB::raw('COUNT(*) as count'))
            ->groupBy('branch')
            ->orderByDesc('revenue')
            ->get();

        // Revenue for last 7 days (for a simple trend)
        $sevenDaysAgo = Carbon::now()->subDays(6)->startOfDay();

        $dailyRevenue = Booking::whereIn('status', ['Approved', 'Completed'])
            ->whereDate('date', '>=', $sevenDaysAgo->toDateString())
            ->select('date', DB::raw('SUM(total_price) as revenue'), DB::raw('COUNT(*) as count'))
            ->groupBy('date')
            ->orderBy('date')
            ->get();

        return view('admin.reports', compact(
            'totalRevenue',
            'totalBookings',
            'pendingCount',
            'approvedCount',
            'completedCount',
            'cancelledCount',
            'revenueByBranch',
            'dailyRevenue'
        ));
    }
}
