<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::apiResource('users', \App\Http\Controllers\Api\User\UserController::class);
Route::group(['prefix' => 'users'], function () {
    Route::put('/{user}/update-password', [\App\Http\Controllers\Api\User\UserController::class, 'updatePassword'])->name('users.updatePassword');
});
