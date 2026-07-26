<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class StripeEvent extends Model
{
    use HasUuids;

    public $timestamps = false; // Solo tiene created_at manual

    protected $fillable = [
        'donation_id',
        'stripe_event_id',
        'event_type',
        'payload',
        'processed',
    ];

    protected $casts = [
        'payload'    => 'string',
        'processed'  => 'boolean',
        'created_at' => 'datetime',
    ];

    public function donation(): BelongsTo
    {
        return $this->belongsTo(Donation::class);
    }
}