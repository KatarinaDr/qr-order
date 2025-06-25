<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Session;

class QrController extends Controller
{
    /*public function scanQr(Request $request)
    {
        Log::info('scanQr called');
        Session::forget('qr_session_start');
        Session::put('qr_session_start', now()->timestamp);
        Session::save();
        Log::info('qr_session_start set to: ' . Session::get('qr_session_start'));

        return redirect()->route('category.articles');
    }

    public function expired()
    {
        return view('qr-expired');
    }*/

    public function scanQr(Request $request)
    {
        //Session::put('qr_session_start', now()->timestamp);

        return redirect()->route('category.articles');
    }

    /*public function expired()
    {
        return view('qr-expired');
    }*/
}
