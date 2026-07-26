<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Collaborator extends Model
{
    use HasUuids;

    protected $fillable = [
        'campaign_id',
        'ref_code',
        'initials',
        'name',
        'email',
        'employee_id',
        'department',
        'personal_goal',
        'is_active',
    ];

    protected $casts = [
        'personal_goal' => 'decimal:2',
        'is_active'     => 'boolean',
    ];

    public function campaign(): BelongsTo
    {
        return $this->belongsTo(Campaign::class);
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function totalRaised(): float
    {
        return $this->donations()->where('status', 'paid')->sum('amount');
    }

    public function donationCount(): int
    {
        return $this->donations()->where('status', 'paid')->count();
    }
}