<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Role\RoleController;
use App\Models\Role\Role;

Route::get('/', [RoleController::class, 'index'])->can('view-any', Role::class);
Route::get('/{role}', [RoleController::class, 'show'])->can('view', 'role');
Route::patch('/{role}', [RoleController::class, 'update'])->can('update', 'role');
