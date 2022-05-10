<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProfileController;

Route::middleware('auth')->group(function () {
  Route::get('/profile/{user}', [ProfileController::class, 'index'])->name('profile');
  Route::put('/profile/{user}', [ProfileController::class, 'update'])->name('profile.update');
});
