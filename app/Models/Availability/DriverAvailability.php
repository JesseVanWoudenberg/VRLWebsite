<?php

namespace App\Models\Availability;

use App\Models\Driver;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DriverAvailability extends Model
{
    use HasFactory;

    public function raceAvailability(): BelongsTo
    {
        return $this->belongsTo(RaceAvailability::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public function availabilityType(): BelongsTo
    {
        return $this->belongsTo(AvailabilityType::class);
    }
}
