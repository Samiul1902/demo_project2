<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\NotificationLog;

class NotificationAdminController extends Controller
{
    /**
     * List notification logs so admins can verify FR‑8 behaviour without a real gateway.[file:1]
     */
    public function index()
    {
        $notifications = NotificationLog::with('booking')
            ->orderByDesc('created_at')
            ->paginate(15);

        return view('admin.notifications', compact('notifications'));
    }
}
