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

            // BOM para Excel en español
            fprintf($handle, chr(0xEF).chr(0xBB).chr(0xBF));

            fputcsv($handle, [
                'Fecha',
                'Hora',
                'Donante',
                'Colaborador',
                'Ref. Colaborador',
                'Departamento',
                'Monto (MXN)',
                'Método de pago',
                'Stripe ID',
                'Solicita CFDI',
                'Tipo de persona',
                'RFC',
                'Razón social',
                'Régimen fiscal',
                'Uso CFDI',
                'Código postal fiscal',
                'Correo fiscal',
                'Correo donante',
                'Estado',
            ]);

            foreach ($donations as $donation) {
                fputcsv($handle, [
                    $donation->paid_at?->format('d/m/Y'),
                    $donation->paid_at?->format('H:i:s'),
                    $donation->donor_name ?? 'Anónimo',
                    $donation->collaborator?->name,
                    $donation->collaborator?->ref_code,
                    $donation->collaborator?->department,
                    number_format($donation->amount, 2),
                    $donation->payment_method ?? 'card',
                    $donation->stripe_payment_intent_id,
                    $donation->wants_invoice ? 'Sí' : 'No',
                    $donation->person_type === 'fisica' ? 'Física' : ($donation->person_type === 'moral' ? 'Moral' : ''),
                    $donation->donor_rfc ?? '',
                    $donation->razon_social ?? '',
                    $donation->regimen_fiscal ?? '',
                    $donation->uso_cfdi ?? '',
                    $donation->codigo_postal ?? '',
                    $donation->fiscal_email ?? '',
                    $donation->donor_email ?? '',
                    'Pagado',
                ]);
            }

            fclose($handle);
        }, 200, $headers);
    }
}