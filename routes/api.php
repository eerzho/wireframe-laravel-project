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
    Route::get('/me', [\App\Http\Controllers\Api\Auth\AuthController::class, 'me']);
    Route::post('/login', [\App\Http\Controllers\Api\Auth\AuthController::class, 'login']);
    Route::delete('/logout', [\App\Http\Controllers\Api\Auth\AuthController::class, 'logout']);
    Route::post('/forgot', [\App\Http\Controllers\Api\Auth\AuthController::class, 'forgot']);
    Route::post('/reset', [\App\Http\Controllers\Api\Auth\AuthController::class, 'reset']);
    Route::view('/reset', 'reset')->name('password.reset');
});
Route::group(['prefix' => 'verify'], function () {
    Route::get('/{id}/{hash}', [\App\Http\Controllers\Api\Verify\VerifyController::class, 'verify'])->name('verification.verify');
    Route::post('/resend', [\App\Http\Controllers\Api\Verify\VerifyController::class, 'resend']);
});
Route::group(['prefix' => 'users'], function () {
    Route::post('/', [\App\Http\Controllers\Api\User\UserController::class, 'index']);
    Route::post('/', [\App\Http\Controllers\Api\User\UserController::class, 'store']);
    Route::get('/{user}', [\App\Http\Controllers\Api\User\UserController::class, 'show']);
    Route::patch('/{user}', [\App\Http\Controllers\Api\User\UserController::class, 'update']);
    Route::delete('/{user}', [\App\Http\Controllers\Api\User\UserController::class, 'destroy']);
    Route::patch('/{user}/update-password', [\App\Http\Controllers\Api\User\UserController::class, 'updatePassword'])->name('users.updatePassword');
});
