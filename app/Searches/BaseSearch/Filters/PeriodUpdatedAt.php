<?php

namespace App\Searches\BaseSearch\Filters;

use App\Interfaces\Filter\FilterInterface;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;

class PeriodUpdatedAt implements FilterInterface
{
    /**
     * @param Builder $builder
     * @param mixed   $value
     *
     * @return Builder
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where(function ($query) use ($value) {

            if ($startAt = Arr::get($value, 'start_at')) {
                $query->where('updated_at', '>=', Carbon::make($startAt));
            }

            if ($endAt = Arr::get($value, 'end_at')) {
                $query->where('updated_at', '<=', Carbon::make($endAt));
            }
        });
    }
}
