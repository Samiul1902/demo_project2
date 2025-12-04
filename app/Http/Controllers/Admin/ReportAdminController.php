<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Booking;
use App\Models\Service;
use App\Models\Staff;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportAdminController extends Controller
{
    /**
     * Show revenue, booking, and performance reports (FR‑14, FR‑15).[file:1]
     */
    public function index(Request $request)
    {
        $range = $request->input('range', 'month'); // day, week, month

        $baseQuery = Booking::whereIn('status', ['Completed', 'Approved']);

        if ($range === 'day') {
            $baseQuery->whereDate('date', now()->toDateString());
        } elseif ($range === 'week') {
            $baseQuery->whereBetween('date', [now()->startOfWeek(), now()->endOfWeek()]);
        } else {
            $baseQuery->whereBetween('date', [now()->startOfMonth(), now()->endOfMonth()]);
        }

        $summary = (clone $baseQuery)
            ->selectRaw('COUNT(*) as total_bookings, SUM(total_price) as total_revenue, SUM(loyalty_points) as total_points')
            ->first();

        $byService = (clone $baseQuery)
            ->select('service_id', DB::raw('COUNT(*) as count'), DB::raw('SUM(total_price) as revenue'))
            ->groupBy('service_id')
            ->with('service')
            ->orderByDesc('count')
            ->take(5)
            ->get();

        $byBranch = (clone $baseQuery)
            ->select('branch', DB::raw('COUNT(*) as count'), DB::raw('SUM(total_price) as revenue'))
            ->groupBy('branch')
            ->orderByDesc('revenue')
            ->get();

        return view('admin.reports', [
            'range'     => $range,
            'summary'   => $summary,
            'byService' => $byService,
            'byBranch'  => $byBranch,
        ]);
    }
}
