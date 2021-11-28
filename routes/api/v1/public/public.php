<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::group(['prefix' => 'users'], base_path('routes/api/v1/public/user/user.php'));
});
