<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckSupervisorAuth
{
    // عمل Middleware للتحقق من مصادقة المشرف
    public function handle(Request $request, Closure $next)
    {
        if (!Auth::guard('supervisor')->check()) {
            // التحقق من وجود معرف المشرف في الجلسة
            if ($request->session()->has('supervisor_id')) {
                return $next($request);
            }
            return redirect()->route('supervisor.login');
        }
        return $next($request);
    }
}
