<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ReservationController;

Route::get('/reservation', [ReservationController::class, 'index'])->name('reservation');
Route::post('/reservation', [ReservationController::class, 'login'])->name('reservation.login');

Route::get('/reservation/confirm', [ReservationController::class, 'confirm'])->name('reservation.confirm');
Route::post('/reservation/confirm', [ReservationController::class, 'store'])->name('reservation.store');

Route::get('/reservation/complete', [ReservationController::class, 'complete'])->name('reservation.complete');
