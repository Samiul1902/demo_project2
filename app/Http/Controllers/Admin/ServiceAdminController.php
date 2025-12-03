<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Service;

class ServiceAdminController extends Controller
{
    /**
     * Admin services management (FR‑10: add/update/remove services and pricing).[file:1]
     */
    public function index()
    {
        $services = Service::orderBy('name')->get();

        return view('admin.services', compact('services'));
    }

    // Later you can add create/store/edit/update/destroy methods
    // to turn the UI buttons into real CRUD operations.
}
