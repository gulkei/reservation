<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\RegisterController;

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register/{keyword}', [RegisterController::class, 'create'])->name('register.create');
