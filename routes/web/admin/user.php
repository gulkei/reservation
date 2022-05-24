<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\UserController;

Route::middleware('auth:admin')->group(function () {
  Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user');
});
