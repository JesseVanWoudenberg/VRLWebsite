<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Season extends Model
{

    public function race(): HasMany
    {
        return $this->hasMany(Race::class);
    }

    public function constructorchampionship(): HasMany
    {
        return $this->hasMany(Constructorchampionship::class);
    }

    public function driverchampionship(): HasMany
    {
        return $this->hasMany(Driverchampionship::class);
    }

    public function tier(): BelongsTo
    {
        return $this->belongsTo(Tier::class);
    }
}
