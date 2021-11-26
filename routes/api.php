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
Route::group(['prefix' => 'auth'], function () {
    Route::post('/login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
    Route::get('/me', [\App\Http\Controllers\Api\Auth\AuthController::class, 'me']);
});
Route::group(['prefix' => 'users'], function () {
    Route::post('/', [\App\Http\Controllers\Api\User\UserController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Api\User\UserController::class, 'post']);
    Route::get('/{user}', [\App\Http\Controllers\Api\User\UserController::class, 'show']);
    Route::patch('/{user}', [\App\Http\Controllers\Api\User\UserController::class, 'update']);
    Route::delete('/{user}', [\App\Http\Controllers\Api\User\UserController::class, 'destroy']);
    Route::patch('/{user}/update-password', [\App\Http\Controllers\Api\User\UserController::class, 'updatePassword'])->name('users.updatePassword');
});
