<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AdminsController;
use App\Http\Controllers\admin\LoginController;

Route::get('/admin/login', [LoginController::class, 'index'])->name('admin.login');
Route::post('/admin/login', [LoginController::class, 'login'])->name('admin.authenticate');

Route::middleware('auth:admin')->group(function () {
  Route::get('/admin/dashboard', [AdminsController::class, 'index'])->name('admin.home');
});
