<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Collaborator;
use App\Models\Donation;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AdminController extends Controller
{
    public function index(): View
    {
        $campaign = Campaign::where('is_active', true)->first();

        if (!$campaign) {
            return view('admin.no-campaign');
        }

        $totalRaised = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'paid')
            ->sum('amount');

        $totalDonations = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'paid')
            ->count();

        $totalCollaborators = Collaborator::where('campaign_id', $campaign->id)
            ->where('is_active', true)
            ->count();

        $leaderboard = Collaborator::where('campaign_id', $campaign->id)
            ->where('is_active', true)
            ->withCount(['donations as paid_donations_count' => function ($q) {
                $q->where('status', 'paid');
            }])
            ->withSum(['donations as total_raised' => function ($q) {
                $q->where('status', 'paid');
            }], 'amount')
            ->orderByDesc('total_raised')
            ->get();

        $recentDonations = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'paid')
            ->with('collaborator')
            ->latest('paid_at')
            ->take(10)
            ->get();

        return view('admin.index', compact(
            'campaign',
            'totalRaised',
            'totalDonations',
            'totalCollaborators',
            'leaderboard',
            'recentDonations'
        ));
    }

    public function exportCsv(): StreamedResponse
    {
        $campaign = Campaign::where('is_active', true)->first();

        $donations = Donation::where('campaign_id', $campaign->id)
            ->where('status', 'paid')
            ->with('collaborator')
            ->latest('paid_at')
            ->get();

        $headers = [
            'Content-Type'        => 'text/csv',
            'Content-Disposition' => 'attachment; filename="donativos-' . now()->format('Y-m-d') . '.csv"',
        ];

        return response()->stream(function () use ($donations) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, ['Fecha', 'Donante', 'Colaborador', 'Departamento', 'Monto (MXN)', 'Stripe ID']);

            foreach ($donations as $donation) {
                fputcsv($handle, [
                    $donation->paid_at?->format('d/m/Y H:i'),
                    $donation->donor_name ?? 'Anónimo',
                    $donation->collaborator?->name,
                    $donation->collaborator?->department,
                    number_format($donation->amount, 2),
                    $donation->stripe_payment_intent_id,
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}