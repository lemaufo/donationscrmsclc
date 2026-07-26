<?php

namespace App\Http\Middleware;

use App\Models\Campaign;
use Closure;
use Illuminate\Http\Request;

class RequireActiveCampaign
{
    public function handle(Request $request, Closure $next)
    {
        $campaign = Campaign::where('is_active', true)->first();

        if (!$campaign) {
            return response()->view('errors.no-campaign', [], 200);
        }

        return $next($request);
    }
}