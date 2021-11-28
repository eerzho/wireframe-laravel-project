<?php

namespace App\Searches\Role\Filters;

use App\Interfaces\Filter\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class Value implements FilterInterface
{
    /**
     * @param Builder $builder
     * @param mixed   $value
     *
     * @return Builder
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('value', $value);
    }
}
