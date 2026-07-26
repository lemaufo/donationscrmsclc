<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Donation extends Model
{
    use HasUuids;

    protected $fillable = [
    'campaign_id',
    'collaborator_id',
    'amount',
    'currency',
    'status',
    'payment_method',
    'stripe_payment_intent_id',
    'donor_name',
    'donor_email',
    'donor_rfc',
    'metadata',
    'paid_at',
    'wants_invoice',
    'person_type',
    'razon_social',
    'fiscal_email',
    'uso_cfdi',
    'regimen_fiscal',
    'codigo_postal',
];

protected $casts = [
    'amount'        => 'decimal:2',
    'metadata'      => 'array',
    'paid_at'       => 'datetime',
    'wants_invoice' => 'boolean',
];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function collaborator(): BelongsTo
    {
        return $this->belongsTo(Collaborator::class);
    }

    public function stripeEvent(): HasOne
    {
        return $this->hasOne(StripeEvent::class);
    }

    public function isPaid(): bool
    {
        return $this->status === 'paid';
    }
}