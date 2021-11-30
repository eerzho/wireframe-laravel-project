<?php

namespace App\Traits;

use Illuminate\Database\Eloquent\Builder;

trait ScopeOfId
{
    /**
     * @param Builder $builder
     * @param         $id
     *
     * @return Builder
     */
    public function scopeOfId(Builder $builder, $id)
    {
        if (is_array($id)) {
            return $builder->whereIn('id', $id);
        }

        return $builder->where('id', $id);
    }
}
