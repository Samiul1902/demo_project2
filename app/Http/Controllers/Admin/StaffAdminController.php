<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;

class StaffAdminController extends Controller
{
    /**
     * Staff list for admins.
     *
     * This view lets salon owners see staff by branch, along with role, rating,
     * and status, preparing for schedule management and availability (FR‑11, FR‑16).[file:1]
     */
    public function index()
    {
        $staff = Staff::orderBy('branch')
            ->orderBy('name')
            ->get();

        return view('admin.staff', compact('staff'));
    }

    // Later you can add create/store/edit/update methods
    // and a separate controller or actions for weekly schedules.
}
