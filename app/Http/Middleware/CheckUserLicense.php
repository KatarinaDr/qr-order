<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckUserLicense
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next)
    {
        $user = Auth::user();

        if ($user->role === 'super_admin') {
            return $next($request);
        }

        if (!$user || !$user->is_active || ($user->license_expires_at && $user->license_expires_at->isPast())) {
            Auth::logout();
            return redirect()->route('license.expired');
        }

        return $next($request);
    }
}
