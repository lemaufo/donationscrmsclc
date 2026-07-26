<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Campaign extends Model
{
    use HasUuids;

    protected $fillable = [
        'name',
        'slug',
        'event_date',
        'starts_at',
        'ends_at',
        'goal_amount',
        'is_active',
        'theme_color',
        'logo_url',
        'banner_url',
        'registration_token',
        'welcome_message',
    ];

    protected $casts = [
        'event_date' => 'date',
        'starts_at'  => 'date',
        'ends_at'    => 'date',
        'goal_amount' => 'decimal:2',
        'is_active'   => 'boolean',
    ];

    public function collaborators(): HasMany
    {
        return $this->hasMany(Collaborator::class);
    }

    public function donations(): HasMany
    {
        return $this->hasMany(Donation::class);
    }

    public function totalRaised(): float
    {
        return $this->donations()->where('status', 'paid')->sum('amount');
    }

    public function isOpen(): bool
    {
        if (!$this->is_active) return false;

        $today = now()->toDateString();

        if ($this->starts_at && $today < $this->starts_at->toDateString()) return false;
        if ($this->ends_at && $today > $this->ends_at->toDateString()) return false;

        return true;
    }
}