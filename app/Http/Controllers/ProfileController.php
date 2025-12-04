<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    /**
     * Show the editable profile for the current demo customer (FR‑1).[file:1]
     *
     * In this prototype there is no authentication, so the first customer record
     * acts as the “current” profile.
     */
    public function edit()
    {
        $customer = Customer::first();

        return view('public.profile', compact('customer'));
    }

    /**
     * Create or update the demo customer profile (FR‑1).[file:1]
     */
    public function update(Request $request)
    {
        $data = $request->validate([
            'name'             => ['required', 'string', 'max:255'],
            'phone'            => ['required', 'string', 'max:50'],
            'email'            => ['nullable', 'email', 'max:255'],
            'preferred_branch' => ['nullable', 'string', 'max:255'],
            'preferred_stylist'=> ['nullable', 'string', 'max:255'],
        ]);

        // For this prototype we keep a single profile row.
        $customer = Customer::first();

        if ($customer) {
            $customer->update($data);
        } else {
            $customer = Customer::create($data);
        }

        return redirect()
            ->route('public.profile')
            ->with('status', 'Your profile has been saved.');
    }
}
