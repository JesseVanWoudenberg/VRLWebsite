<?php

namespace App\Models\Availability;

use App\Models\Race;
use App\Models\Season;
use App\Models\Tier;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RaceAvailability extends Model
{
    use HasFactory;

    public function season(): BelongsTo
    {
        return $this->belongsTo(Season::class);
    }

    public function tier(): BelongsTo
    {
        return $this->belongsTo(Tier::class);
    }

    public function race(): BelongsTo
    {
        return $this->belongsTo(Race::class);
    }

    public function driverAvailability(): HasMany
    {
        return $this->hasMany(DriverAvailability::class);
    }
}
