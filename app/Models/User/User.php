<?php

namespace App\Models\User;

use App\Components\DateFormat\DateFormatHelper;
use App\Interfaces\Morphable\MorphableInterface;
use App\Traits\ScopeOfId;
use Carbon\Carbon;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

/**
 * @property int    $id
 * @property string $first_name
 * @property string $last_name
 * @property string $username
 * @property string $email
 * @property string $password
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class User extends Authenticatable implements MorphableInterface, MustVerifyEmail
{
    use HasFactory, Notifiable, ScopeOfId, HasApiTokens;

    protected $fillable = [
        'first_name',
        'last_name',
        'username',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => DateFormatHelper::CAST_DATETIME_FORMAT,
        'created_at'        => DateFormatHelper::CAST_DATETIME_FORMAT,
        'updated_at'        => DateFormatHelper::CAST_DATETIME_FORMAT
    ];
}
