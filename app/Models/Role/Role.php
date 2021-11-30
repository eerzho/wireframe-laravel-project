<?php

namespace App\Models\Role;

use App\Models\BaseModel\BaseModel;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string          $name
 * @property int             $value
 * @property-read Collection $users
 */
class Role extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function users()
    {
        return $this->belongsToMany(
            User::class,
            'user_role_assignment',
            'role_id',
            'user_id');
    }
}
