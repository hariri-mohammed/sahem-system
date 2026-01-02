<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ManagerAuthController extends Controller
{
    public function showLogin()
    {
        return view('html.login.manager_login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        if (Auth::guard('manager')->attempt($credentials, $request->filled('remember'))) {
            $request->session()->regenerate();
            $request->session()->put('manager_id', Auth::guard('manager')->id());
            return redirect()->intended(route('manager.dashboard'));
        }

        return back()->withErrors(['email' => 'بيانات الدخول غير صحيحة'])->withInput();
    }

    public function logout(Request $request)
    {
        Auth::guard('manager')->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect()->route('manager.login');
    }
}
