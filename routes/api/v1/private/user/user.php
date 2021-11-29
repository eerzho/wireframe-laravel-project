<?php

use App\Http\Controllers\Api\V1\User\UserController;
use App\Http\Controllers\Api\V1\User\UserRoleController;
use App\Models\User\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->can('view-any', User::class);
Route::get('/{user}', [UserController::class, 'show'])->can('view', 'user');
Route::patch('/{user}', [UserController::class, 'update'])->can('update', 'user');
Route::delete('/{user}', [UserController::class, 'destroy'])->can('delete', 'user');
Route::patch('/{user}/update-password', [UserController::class, 'updatePassword'])->can('update', 'user');

Route::group(['prefix' => '{user}'], function () {
    Route::put('/attach-roles', [UserRoleController::class, 'attach'])->can('edit-role', 'user');
    Route::put('/detach-roles', [UserRoleController::class, 'detach'])->can('edit-role', 'user');
});
