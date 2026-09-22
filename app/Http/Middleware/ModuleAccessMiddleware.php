<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ModuleAccessMiddleware
{
    public function handle(Request $request, Closure $next, string $module, string $level = 'read'): Response
    {
        $user = $request->user();

        if (! $user) {
            return redirect('/login');
        }

        if (! $user->canAccessModule($module, $level)) {
            abort(403, 'Anda tidak memiliki akses ke halaman ini.');
        }

        return $next($request);
    }
}
