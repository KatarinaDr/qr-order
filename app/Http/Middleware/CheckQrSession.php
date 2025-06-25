<?php
/*
namespace App\Http\Middleware;

use App\Models\Setting;
use Closure;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Session;

class CheckQrSession
{
    public function handle(Request $request, Closure $next)
    {
        if (Session::has('qr_session_start')) {
            $startTime = Session::get('qr_session_start');
            $currentTime = now()->timestamp;
            $timeElapsed = $currentTime - $startTime;

            $sessionDuration = (int) Setting::get('session', 5);

            if ($timeElapsed > $sessionDuration) {
                Session::forget('qr_session_start');
                return redirect()->route('qr.expired')->with('message', 'Vaša sesija je istekla, skenirajte opet QR kod.');
            }
        }

        return $next($request);
    }


}*/
