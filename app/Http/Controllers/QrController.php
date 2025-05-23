<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class QrController extends Controller
{
    public function scanQr(Request $request){
        Session::put('qr_session_start', now()->timestamp);

        return redirect()->route('category.articles');
    }

    public function expired(){
        return view('qr-expired');
    }
}
