<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

use Illuminate\Support\Facades\Session;

class CheckQrSession
{
    /**
     * Handle an incoming request.
     *
     */
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('qr_session_start')) {
            $startTime = Session::get('qr_session_start');
            $currentTime = now()->timestamp;
            $timeElapsed = $currentTime - $startTime;

            if ($timeElapsed > 300) {
               // Session::forget('qr_session_start');
                return redirect()->route('qr.expired')->with('message', 'Vaša sesija je istekla, skenirajte opet QR kod.');
            }
        }

        return $next($request);
    }

}
