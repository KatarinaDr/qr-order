<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Validation\Rules;
use App\Models\Waiter;

class RegisterController extends Controller
{
    public function showRegistrationForm()
    {
        $licenseKey = $this->generateUniqueLicenseKey();
        return view('auth.register', compact('licenseKey'));
    }

    public function register(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'license_key' => ['required', 'string', 'size:5', 'unique:users'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        $managerRole = Role::where('name', 'manager')->firstOrFail();

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'license_key' => $request->license_key,
            'role_id' => $managerRole->id,
            'is_active' => false,
            'can_access_dashboard' => false,
        ]);

        return redirect()->route('register.success', ['license_key' => $user->license_key]);
    }

    public function showSuccess(Request $request)
    {
        $licenseKey = $request->query('license_key');
        return view('auth.register-success', compact('licenseKey'));
    }

    protected function generateUniqueLicenseKey(): string
    {
        do {
            $key = Str::random(5);
        } while (User::where('license_key', $key)->exists());

        return $key;
    }

    public function registerWaiter()
    {
        return view('auth.register-waiter');
    }

    public function registerWaiterPost(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:waiters,email'],
            'password' => ['required', 'confirmed', \Illuminate\Validation\Rules\Password::defaults()],
        ]);

        Waiter::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => \Illuminate\Support\Facades\Hash::make($request->password),
        ]);

        return redirect()->route('login')->with('success', 'Konobar je uspješno registrovan.');
    }


}
