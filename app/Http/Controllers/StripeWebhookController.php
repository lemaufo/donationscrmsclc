<?php

namespace App\Http\Controllers;

use App\Models\Donation;
use App\Models\StripeEvent;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Webhook;

class StripeWebhookController extends Controller
{
    public function handle(Request $request): Response
    {
        $payload   = $request->getContent();
        $sigHeader = $request->header('Stripe-Signature');
        $secret    = config('services.stripe.webhook_secret');

        try {
            $event = Webhook::constructEvent($payload, $sigHeader, $secret);
        } catch (SignatureVerificationException $e) {
            return response('Firma invalida', 400);
        } catch (\Exception $e) {
            return response('Error: ' . $e->getMessage(), 400);
        }

        // Idempotencia
        if (StripeEvent::where('stripe_event_id', $event->id)->exists()) {
            return response('Ya procesado', 200);
        }

        // Registrar evento — en try/catch para no fallar si hay error de DB
        try {
    $stripeEvent = StripeEvent::create([
        'stripe_event_id' => $event->id,
        'event_type'      => $event->type,
        'payload'         => $payload, // ← usa el raw payload string directamente
        'processed'       => false,
        'created_at'      => now(),
    ]);
} catch (\Exception $e) {
    \Log::error('StripeEvent create error: ' . $e->getMessage());
    return response('DB Error', 500);
}

        // Procesar evento
        try {
            match ($event->type) {
                'payment_intent.succeeded'      => $this->handlePaymentSucceeded($event, $stripeEvent),
                'payment_intent.payment_failed' => $this->handlePaymentFailed($event, $stripeEvent),
                default => null,
            };
        } catch (\Exception $e) {
            \Log::error('Webhook processing error: ' . $e->getMessage());
        }

        return response('OK', 200);
    }

    private function handlePaymentSucceeded($event, StripeEvent $stripeEvent): void
    {
        $paymentIntent = $event->data->object;

        $donation = Donation::where('stripe_payment_intent_id', $paymentIntent->id)->first();

        if (!$donation) {
            \Log::warning('Donation not found for payment_intent: ' . $paymentIntent->id);
            return;
        }

        $donation->update([
            'status'  => 'paid',
            'paid_at' => now(),
        ]);

        $stripeEvent->update([
            'donation_id' => $donation->id,
            'processed'   => true,
        ]);
    }

    private function handlePaymentFailed($event, StripeEvent $stripeEvent): void
    {
        $paymentIntent = $event->data->object;

        $donation = Donation::where('stripe_payment_intent_id', $paymentIntent->id)->first();

        if (!$donation) return;

        $donation->update(['status' => 'failed']);

        $stripeEvent->update([
            'donation_id' => $donation->id,
            'processed'   => true,
        ]);
    }
}