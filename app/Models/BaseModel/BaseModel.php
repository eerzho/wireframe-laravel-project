<?php

namespace App\Models\BaseModel;

use App\Components\DateFormat\DateFormatHelper;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    $id
 * @property Carbon $created_at
 * @property Carbon $updated_at
 */
class BaseModel extends Model
{
    protected $casts = [
        'created_at' => DateFormatHelper::CAST_DATETIME_FORMAT,
        'updated_at' => DateFormatHelper::CAST_DATETIME_FORMAT
    ];

    /**
     * @param Builder $builder
     * @param int     $id
     *
     * @return Builder
     */
    public function scopeOfId(Builder $builder, int $id)
    {
        return $builder->where('id', $id);
    }
}
