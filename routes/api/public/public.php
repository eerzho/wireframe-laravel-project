<?php

use Illuminate\Support\Facades\Route;

Route::group([], function () {
    Route::group(['prefix' => 'users'], base_path('routes/api/public/user/user.php'));
});
