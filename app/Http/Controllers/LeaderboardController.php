<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Collaborator;
use App\Models\Donation;
use Illuminate\View\View;

class LeaderboardController extends Controller
{
    public function index(): View
    {
        $campaign = Campaign::where('is_active', true)->first();

        $totalRaised = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'paid')
            ->sum('amount');

        $totalDonations = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'paid')
            ->count();

        $leaderboard = Collaborator::where('campaign_id', $campaign->id)
            ->where('is_active', true)
            ->withSum(['donations as total_raised' => fn($q) => $q->where('status', 'paid')], 'amount')
            ->withCount(['donations as paid_donations_count' => fn($q) => $q->where('status', 'paid')])
            ->orderByDesc('total_raised')
            ->get();

        $recentDonations = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'paid')
            ->with('collaborator')
            ->latest('paid_at')
            ->take(5)
            ->get();

        $goalAmount = $campaign->goal_amount ?? 0;
        $progress   = $goalAmount > 0 ? min(100, ($totalRaised / $goalAmount) * 100) : 0;

        return view('leaderboard.index', compact(
            'campaign',
            'totalRaised',
            'totalDonations',
            'leaderboard',
            'recentDonations',
            'goalAmount',
            'progress'
        ));
    }
}