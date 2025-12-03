<?php

namespace App\Http\Controllers;

use App\Models\Service;

class ServiceController extends Controller
{
    /**
     * Public services list (FR‑2: browse services and pricing).[file:1]
     */
    public function index()
    {
        $services = Service::where('status', 'Active')
            ->orderBy('name')
            ->get();

        return view('public.services', compact('services'));
    }

    /**
     * Public service detail page.
     */
    public function show(Service $service)
    {
        // Later you can eager-load reviews, related services, etc.
        return view('public.service-detail', compact('service'));
    }
}
