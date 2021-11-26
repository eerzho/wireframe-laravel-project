<?php

namespace App\Models\BaseModel;

use App\Components\DateFormat\DateFormatHelper;
use App\Traits\ScopeOfId;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class BaseModel extends Model
{
    use ScopeOfId;

    protected $casts = [
        'created_at' => DateFormatHelper::CAST_DATETIME_FORMAT,
        'updated_at' => DateFormatHelper::CAST_DATETIME_FORMAT
    ];
}
