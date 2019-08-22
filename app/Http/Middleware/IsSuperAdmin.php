<?php

namespace App\Http\Middleware;

use Closure;

class IsSuperAdmin
{
    public function handle($request, Closure $next)
    {
        if(auth()->user()->isSuperAdmin()) {
            return $next($request);
        }
        return redirect('admin/admins');
    }
}