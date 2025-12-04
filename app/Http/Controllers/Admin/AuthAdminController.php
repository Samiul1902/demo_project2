<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthAdminController extends Controller
{
    /**
     * Show a very simple admin login form (prototype RBAC).[file:1]
     */
    public function showLoginForm()
    {
        return view('admin.login');
    }

    /**
     * Handle login with a shared admin password from .env.[file:1]
     */
    public function login(Request $request)
    {
        $request->validate([
            'password' => ['required', 'string'],
        ]);

        $expected = config('admin.shared_password');

        if (!$expected || $request->input('password') !== $expected) {
            return back()->withErrors([
                'password' => 'Invalid admin password.',
            ]);
        }

        $request->session()->put('is_admin', true);

        return redirect()->route('admin.dashboard');
    }

    /**
     * Logout admin session.
     */
    public function logout(Request $request)
    {
        $request->session()->forget('is_admin');

        return redirect()->route('home');
    }
}
