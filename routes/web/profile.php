<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
  Route::get('/profile', [ProfileController::class, 'index'])->name('profile');
});
