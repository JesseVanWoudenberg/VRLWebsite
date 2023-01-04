<?php

namespace App\Models;

use App\Models\Availability\RaceAvailability;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Tier extends Model
{
    use HasFactory;

    public function season(): HasMany
    {
        return $this->hasMany(Season::class);
    }

    public function driver(): HasMany
    {
        return $this->hasMany(Driver::class);
    }

    public function Race(): HasMany
    {
        return $this->hasMany(Race::class);
    }

    public function driverchampionship(): HasMany
    {
        return $this->hasMany(Driverchampionship::class);
    }

    public function constructorchampionship(): HasMany
    {
        return $this->hasMany(Constructorchampionship::class);
    }

    public function raceAvailability(): HasMany
    {
        return $this->hasMany(RaceAvailability::class);
    }
}
