<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ForgotPasswordController;

Route::get('/forgot-password', [ForgotPasswordController::class, 'index'])->name('password.request');
