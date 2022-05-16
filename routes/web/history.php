<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\HistoryController;

Route::middleware('auth')->group(function () {
  Route::get('/history', [HistoryController::class, 'index'])->name('history');
});
