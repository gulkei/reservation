<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\TemporaryUserController;

Route::get('/temporary', [TemporaryUserController::class, 'index'])->name('temporary');
Route::post('/temporary', [TemporaryUserController::class, 'confirm'])->name('temporary.confirm');
