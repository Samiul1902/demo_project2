<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Staff;

class StaffAdminController extends Controller
{
    public function index()
    {
        $staff = Staff::orderBy('name')->get();
        return view('admin.staff', compact('staff'));
    }
}
