<?php

use App\Http\Controllers\Verify\VerifyController;
use Illuminate\Support\Facades\Route;

Route::get('/{id}/{hash}', [VerifyController::class, 'verify'])->name('verification.verify');
Route::post('/resend', [VerifyController::class, 'resend'])->middleware('auth:sanctum');
