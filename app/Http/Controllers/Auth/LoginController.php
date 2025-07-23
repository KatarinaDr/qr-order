<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::guard('waiter')->attempt($credentials)) {
            $request->session()->regenerate();

            return redirect()->route('tables');
        }

        return back()->withErrors([
            'email' => 'Pogrešan email ili lozinka.',
        ]);
    }

}
