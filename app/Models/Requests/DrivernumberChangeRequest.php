<?php

namespace App\Models\Requests;

use App\Models\Driver;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class DrivernumberChangeRequest extends Model
{
    use HasFactory;

    public function requestStatus(): BelongsTo
    {
        return $this->belongsTo(RequestStatus::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }
}
