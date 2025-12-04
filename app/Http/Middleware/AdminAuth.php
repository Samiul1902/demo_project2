<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AdminAuth
{
    /**
     * Very simple admin gate for /admin routes, matching RBAC idea in NFR‑9.[file:1]
     */
    public function handle(Request $request, Closure $next): Response
    {
        // If already logged in as admin, continue.
        if ($request->session()->get('is_admin', false) === true) {
            return $next($request);
        }

        // Allow access to the login form and login POST without being logged in.
        if ($request->is('admin/login') || $request->is('admin/login*')) {
            return $next($request);
        }

        // Otherwise, redirect to admin login.
        return redirect()->route('admin.login.form');
    }
}
