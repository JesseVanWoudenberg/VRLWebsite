<?php

namespace App\Models\Requests;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Drivernumberchangerequest extends Model
{
    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function requeststatus(): BelongsTo
    {
        return $this->belongsTo(Requeststatus::class);
    }
}
