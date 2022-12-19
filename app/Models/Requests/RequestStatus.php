<?php

namespace App\Models\Requests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RequestStatus extends Model
{
    use HasFactory;

    public function drivernumberChangeRequest(): HasMany
    {
        return $this->hasMany(DrivernumberChangeRequest::class);
    }

    public function teamTransferRequest(): HasMany
    {
        return $this->hasMany(TeamTransferRequest::class);
    }

}
