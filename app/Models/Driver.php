<?php

namespace App\Models;

use App\Models\Availability\DriverAvailability;
use App\Models\Requests\DrivernumberChangeRequest;
use App\Models\Requests\TeamTransferRequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Driver extends Model
{
    use hasFactory;

    public function racedriver(): HasMany
    {
        return $this->hasMany(Racedriver::class);
    }

    public function driverchampionship(): HasMany
    {
        return $this->hasMany(Driverchampionship::class);
    }

    public function fastestlap(): HasMany
    {
        return $this->hasMany(Fastestlap::class);
    }

    public function team(): BelongsTo
    {
        return $this->belongsTo(Team::class);
    }

    public function tier(): BelongsTo
    {
        return $this->belongsTo(Tier::class);
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

    public function user(): HasMany
    {
        return $this->hasMany(User::class);
    }

    public function drivernumberChangeRequest(): HasMany
    {
        return $this->hasMany(DrivernumberChangeRequest::class);
    }

    public function teamTransferRequest(): HasMany
    {
        return $this->hasMany(TeamTransferRequest::class);
    }

    public function driverAvailability(): HasMany
    {
        return $this->hasMany(DriverAvailability::class);
    }
}
