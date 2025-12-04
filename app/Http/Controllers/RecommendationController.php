<?php

namespace App\Http\Controllers;

use App\Models\Booking;
use App\Models\Customer;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RecommendationController extends Controller
{
    public function index(Request $request)
    {
        $customer = Customer::first();

        $services = Service::where('status', 'Active')->get();

        // Simple placeholder scoring.
        $services = $services->map(function (Service $s) use ($customer) {
            $s->recommendation_score = 0;
            return $s;
        });

        $recommended = $services->take(5);

        return view('public.recommendations', [
            'customer'    => $customer,
            'recommended' => $recommended,
        ]);
    }
}
