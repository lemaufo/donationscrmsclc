<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class RequireNonViewer
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->user()->isSuperAdmin()) {
            abort(403);
        }
        return $next($request);
    }
}