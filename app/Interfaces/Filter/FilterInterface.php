<?php

namespace App\Interfaces\Filter;

use Illuminate\Database\Eloquent\Builder;

interface FilterInterface
{
    /**
     * @param Builder $builder
     * @param mixed   $value
     *
     * @return Builder
     */
    public static function apply(Builder $builder, $value): Builder;
}
