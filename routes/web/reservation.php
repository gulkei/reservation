<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\LoginController;
use App\Http\Controllers\ReservationController;

Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation');
Route::post('/reservation', [LoginController::class, 'authenticate'])->name('reservation.login');

Route::get('/reservation/confirm', [ReservationController::class, 'confirm'])->name('reservation.confirm');
