<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\ReserveController;

Route::middleware('auth:admin')->group(function () {
  Route::get('/admin/reserve', [ReserveController::class, 'index'])->name('admin.reserve');
  Route::get('/admin/reserve-detail', [ReserveController::class, 'detail'])->name('admin.reserve-detail');
});
