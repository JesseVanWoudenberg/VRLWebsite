<?php

namespace App\Models;

use App\Models\Requests\Drivernumberchangerequest;
use App\Models\Requests\Teamtransferrequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function log(): HasMany
    {
        return $this->hasMany(Log::class);
    }

    public function drivernumberChangeRequest(): HasMany
    {
        return $this->hasMany(DrivernumberChangeRequest::class);
    }

    public function teamTransferRequest(): HasMany
    {
        return $this->hasMany(TeamTransferRequest::class);
    }

    public function driver(): BelongsTo
    {
        return $this->belongsTo(Driver::class);
    }

    public static function checkPermissions(string $permission)
    {
        if(Auth::check()) {
            if (!Auth::user()->hasPermissionTo($permission)) {
                abort(403);
            }
        } else {
            abort(403);
        }
    }
}
