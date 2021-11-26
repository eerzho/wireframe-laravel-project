<?php

namespace App\Providers;

use App\Constants\Relations\RelationVariables;
use App\Models\User\User;
use Illuminate\Database\Eloquent\Relations\Relation;
use Illuminate\Support\ServiceProvider;

class RelationServiceProvider extends ServiceProvider
{
    public function boot()
    {
        Relation::morphMap([
            RelationVariables::USER => User::class,
        ]);
    }
}
