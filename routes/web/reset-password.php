<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ResetPasswordController;

Route::get('/reset-password/{token}', [ResetPasswordController::class, 'index'])->name('password.reset');
Route::post('/reset-password', [ResetPasswordController::class, 'update'])->name('password.update');
