<?php

use App\Http\Controllers\Api\V1\User\UserController;
use App\Models\User\User;
use Illuminate\Support\Facades\Route;

Route::get('/', [UserController::class, 'index'])->can('view-any', User::class);
Route::get('/{user}', [UserController::class, 'show'])->can('view', 'user');
Route::patch('/{user}', [UserController::class, 'update'])->can('update', 'user');
Route::delete('/{user}', [UserController::class, 'destroy'])->can('delete', 'user');
Route::patch('/{user}/update-password', [UserController::class, 'updatePassword'])->can('update', 'user');
