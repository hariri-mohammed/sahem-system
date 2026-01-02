<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckManagerAuth
{
    // عمل Middleware للتحقق من مصادقة المدير
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('manager')->check()) {
            // التحقق من وجود معرف المدير في الجلسة
            if ($request->session()->has('manager_id')) {
                return $next($request);
            }
            return redirect()->route('manager.login');
        }
        return $next($request);
    }
}
