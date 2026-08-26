<?php

namespace App\Http\Controllers;

use App\Models\Campaign;
use App\Models\Collaborator;
use App\Models\Donation;
use App\Services\StripeService;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DonationController extends Controller
{
    public function __construct(protected StripeService $stripeService) {}

    public function show(Request $request): View
    {
        $ref      = $request->query('ref');
        $campaign = Campaign::where('is_active', true)->first();

        $collaborator = null;
        if ($ref) {
            $collaborator = Collaborator::where('ref_code', $ref)
                ->where('is_active', true)
                ->first();
        }

        return view('donation.show', compact('collaborator', 'campaign', 'ref'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
        'amount'          => 'required|numeric|min:50|max:100000',
        'collaborator_id' => 'nullable|exists:collaborators,id',
        'campaign_id'     => 'required|exists:campaigns,id',
        'donor_name'      => 'required|string|max:255',
        'donor_email'     => 'nullable|email|max:255',
        'donor_rfc'       => 'nullable|string|max:13',
    ], [
        'amount.required'     => 'El monto es obligatorio.',
        'amount.numeric'      => 'El monto debe ser un número válido.',
        'amount.min'          => 'El monto mínimo es de $50 MXN.',
        'amount.max'          => 'El monto máximo por transacción es de $100,000 MXN.',
        'donor_name.required' => 'El nombre completo es obligatorio.',
        'donor_email.email'   => 'Ingresa un correo electrónico válido.',
    ]);

    // PLD: Tope $180,000 MXN en 6 meses por RFC
    if (!empty($validated['donor_rfc'])) {
        $sixMonthsAgo = now()->subMonths(6);

        $accumulated = \App\Models\Donation::where('donor_rfc', strtoupper($validated['donor_rfc']))
            ->where('status', 'paid')
            ->where('paid_at', '>=', $sixMonthsAgo)
            ->sum('amount');

        if ($accumulated + $validated['amount'] > 180000) {
            return back()->withInput()->withErrors([
                'donor_rfc' => 'Este RFC ha alcanzado el límite de $180,000 MXN en donativos en los últimos 6 meses (requerimiento fiscal).'
            ]);
        }
    }

    // Tope por transacción $100,000 MXN
    if ($validated['amount'] > 100000) {
        return back()->withInput()->withErrors([
            'amount' => 'El monto máximo por donativo es de $100,000 MXN.'
        ]);
    }

    $donation = \App\Models\Donation::create([
        'campaign_id'     => $validated['campaign_id'],
        'collaborator_id' => $validated['collaborator_id'] ?? null,
        'amount'          => $validated['amount'],
        'currency'        => 'MXN',
        'status'          => 'pending',
        'donor_name'      => $validated['donor_name'],
        'donor_email'     => $validated['donor_email'] ?? null,
        'donor_rfc'       => strtoupper($validated['donor_rfc'] ?? ''),
    ]);

    $intent   = $this->stripeService->createPaymentIntent($donation);
    $campaign = \App\Models\Campaign::where('is_active', true)->first();

    return view('donation.payment', [
        'donation'      => $donation,
        'client_secret' => $intent['client_secret'],
        'stripe_key'    => config('services.stripe.key'),
        'campaign'      => $campaign,
    ]);
}

    public function success(Request $request, \App\Models\Donation $donation): View
    {
        $campaign = \App\Models\Campaign::where('is_active', true)->first();
        return view('donation.success', compact('donation', 'campaign'));
    }
}