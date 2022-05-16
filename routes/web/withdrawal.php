<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\WithdrawalController;

Route::middleware('auth')->group(function () {
  Route::get('/withdrawal', [WithdrawalController::class, 'index'])->name('withdrawal');

  Route::get('/withdrawal/delete', [WithdrawalController::class, 'delete'])->name('withdrawal.delete');
});
