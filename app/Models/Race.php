<?php

namespace App\Models;

use App\Models\Availability\RaceAvailability;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Race extends Model
{
    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function track(): BelongsTo
    {
        return $this->belongsTo(Track::class);
    }

    public function tier(): BelongsTo
    {
        return $this->belongsTo(Tier::class);
    }

    public function raceformat(): BelongsTo
    {
        return $this->belongsTo(Raceformat::class);
    }

    public function fastestlap(): HasMany
    {
        return $this->HasMany(Fastestlap::class);
    }

    public function racedriver(): HasMany
    {
        return $this->hasMany(Racedriver::class);
    }

    public function qualifyingdriver(): HasMany
    {
        return $this->hasMany(Qualifyingdriver::class);
    }

    public function shortqualifyingdriver(): HasMany
    {
        return $this->hasMany(Shortqualifyingdriver::class);
    }

    public function penaltypoint(): HasMany
    {
        return $this->hasMany(Penaltypoint::class);
    }

    public function raceAvailability(): HasMany
    {
        return $this->hasMany(RaceAvailability::class);
    }
}
