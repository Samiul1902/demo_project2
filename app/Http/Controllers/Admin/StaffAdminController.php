<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;
use Illuminate\Http\Request;

class StaffAdminController extends Controller
{
    /**
     * List all staff members with basic schedule fields (FR‑11).[file:1]
     */
    public function index()
    {
        $staff = Staff::orderBy('branch')
            ->orderBy('name')
            ->get();

        return view('admin.staff', compact('staff'));
    }

    /**
     * Update a staff member's schedule and availability (FR‑11).[file:1]
     */
    public function updateSchedule(Staff $staff, Request $request)
    {
        $data = $request->validate([
            'shift_start' => ['nullable', 'string', 'max:50'],
            'shift_end'   => ['nullable', 'string', 'max:50'],
            'weekly_off'  => ['nullable', 'string', 'max:50'],
            'status'      => ['required', 'in:Active,Inactive'],
        ]);

        $staff->update($data);

        return redirect()
            ->route('admin.staff')
            ->with('status', 'Schedule updated for '.$staff->name.'.');
    }
}
