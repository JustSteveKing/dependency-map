<?php

declare(strict_types=1);

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUlids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

final class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasUlids;
    use Notifiable;
    use SoftDeletes;

    protected $fillable = [
        'name',
        'nickname',
        'email',
        'avatar',
        'provider_id',
        'access_token',
        'refresh_token',
    ];

    protected $hidden = [
        'provider_id',
        'access_token',
        'refresh_token',
    ];
}
