<?php

namespace App\Services;

use App\Models\Donation;
use Stripe\StripeClient;

class StripeService
{
    protected StripeClient $stripe;

    public function __construct()
    {
        $this->stripe = new StripeClient(config('services.stripe.secret'));
    }

    public function createPaymentIntent(Donation $donation): array
    {
        $intent = $this->stripe->paymentIntents->create([
            'amount'   => (int) ($donation->amount * 100),
            'currency' => strtolower($donation->currency),
            'metadata' => [
                'donation_id'     => $donation->id,
                'collaborator_id' => $donation->collaborator_id,
                'campaign_id'     => $donation->campaign_id,
                'ref_code'        => $donation->collaborator->ref_code ?? null,
            ],
        ]);

        $donation->update([
            'stripe_payment_intent_id' => $intent->id,
        ]);

        return [
            'client_secret' => $intent->client_secret,
            'intent_id'     => $intent->id,
        ];
    }
}