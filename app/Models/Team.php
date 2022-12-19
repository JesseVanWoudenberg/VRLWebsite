<?php

namespace App\Models;

use App\Models\Requests\Teamtransferrequest;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Team extends Model
{
    use HasFactory;

    public function driver(): HasMany
    {
        return $this->hasMany(Driver::class);
    }

    public function fastestlap(): HasMany
    {
        return $this->hasMany(Fastestlap::class);
    }

    public function driverchampionship(): HasMany
    {
        return $this->hasMany(Driverchampionship::class);
    }

    public function constructorchampionship(): HasMany
    {
        return $this->hasMany(Constructorchampionship::class);
    }

    public function racedriver(): HasMany
    {
        return $this->hasMany(Racedriver::class);
    }

    public function powerunit(): BelongsTo
    {
        return $this->belongsTo(Powerunit::class);
    }

    public function qualifyingdriver(): HasMany
    {
        return $this->hasMany(Qualifyingdriver::class);
    }

    public function shortqualifyingdriver(): HasMany
    {
        return $this->hasMany(Shortqualifyingdriver::class);
    }

    public function teamTransferRequest(): HasMany
    {
        return $this->hasMany(TeamTransferRequest::class);
    }
}
