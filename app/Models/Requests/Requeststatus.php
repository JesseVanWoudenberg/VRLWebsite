<?php

namespace App\Models\Requests;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Requeststatus extends Model
{
    use HasFactory;

    public function drivernumberchangerequest(): HasMany
    {
        return $this->hasMany(Drivernumberchangerequest::class);
    }

    public function teamtransferrequest(): HasMany
    {
        return $this->hasMany(Teamtransferrequest::class);
    }
}
