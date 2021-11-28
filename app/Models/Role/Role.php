<?php

namespace App\Models\Role;

use App\Models\BaseModel\BaseModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * @property string $name
 * @property int    $value
 */
class Role extends BaseModel
{
    use HasFactory;

    protected $fillable = [
        'name',
        'value',
    ];
}
