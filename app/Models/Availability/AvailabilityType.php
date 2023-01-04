<?php

namespace App\Models\Availability;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AvailabilityType extends Model
{
    use HasFactory;

    public function driverAvailability(): HasMany
    {
        return $this->hasMany(DriverAvailability::class);
    }
}
