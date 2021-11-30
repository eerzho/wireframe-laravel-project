<?php

namespace App\Searches\User\Filters;

use Eerzho\LaravelComponents\Interfaces\Filter\FilterInterface;
use Illuminate\Database\Eloquent\Builder;

class Email implements FilterInterface
{
    /**
     * @param Builder $builder
     * @param mixed   $value
     *
     * @return Builder
     */
    public static function apply(Builder $builder, $value): Builder
    {
        return $builder->where('email', 'LIKE', '%' . $value . '%');
    }
}
