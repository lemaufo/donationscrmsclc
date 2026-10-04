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

        $now = now();

        // Antes de la fecha de inicio
        if ($campaign->starts_at && $now->lt($campaign->starts_at)) {
            return response()->view('errors.campaign-upcoming', [
                'campaign'  => $campaign,
                'starts_at' => $campaign->starts_at,
            ], 200);
        }

        // Después de la fecha de fin
        if ($campaign->ends_at && $now->gt($campaign->ends_at)) {
            return response()->view('errors.campaign-ended', [
                'campaign' => $campaign,
                'ends_at'  => $campaign->ends_at,
            ], 200);
        }

        return $next($request);
    }
}