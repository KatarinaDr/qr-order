<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Carbon\Carbon;

class CheckUserLicense
{
    public function handle(Request $request, Closure $next): Response
    {
        $user = Auth::user();

        if (!$user) {
            return redirect()->route('login');
        }

        if ($user->role?->name === 'super_admin') {
            return $next($request);
        }

        if ($user->role?->name === 'manager') {
            if ($user->license_expires_at && $user->license_expires_at->isPast()) {
                $user->is_active = false;
                $user->saveQuietly();

                Auth::logout();
                return redirect()->route('license.expired');
            }

            if (!$user->is_active) {
                Auth::logout();
                return redirect()->route('license.expired');
            }
        }

        return $next($request);
    }
}
