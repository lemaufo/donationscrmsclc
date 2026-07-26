<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Donation;
use Illuminate\View\View;

class LandingController extends Controller
{
    public function index(): View
    {
        $campaign = Campaign::where('is_active', true)->first();

        $totalRaised    = 0;
        $totalDonations = 0;

        if ($campaign) {
            $totalRaised    = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'paid')->sum('amount');
            $totalDonations = Donation::where('campaign_id', $campaign->id)
                ->where('status', 'paid')->count();
        }

        return view('landing', compact('campaign', 'totalRaised', 'totalDonations'));
    }
}