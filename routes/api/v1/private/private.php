<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::group(['prefix' => 'users'], base_path('routes/api/v1/private/user/user.php'));
    Route::group(['prefix' => 'roles'], base_path('routes/api/v1/private/role/role.php'));
});
