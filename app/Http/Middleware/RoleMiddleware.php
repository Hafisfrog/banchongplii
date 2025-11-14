<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = auth()->user();

        // ถ้าไม่ได้ล็อกอิน → redirect ไป login
        if (!$user) {
            return redirect()->route('login');
        }

        // ถ้า role ไม่ตรง → 403 Forbidden
        if (!$user->hasRole($roles)) {
            abort(403, 'You do not have permission to access this page.');
        }

        return $next($request);
    }
}
