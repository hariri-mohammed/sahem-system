<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Supervisor;

class SupervisorAuthController extends Controller
{
    public function showLogin()
    {
        return view('html.login.supervisor_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('supervisor')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            // optional backward compatibility for legacy code
            $request->session()->put('supervisor_id', Auth::guard('supervisor')->id());
            return redirect()->intended(route('supervisor.dashboard'));
        }

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('supervisor')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('supervisor.login');
    }
}
