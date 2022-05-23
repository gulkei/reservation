<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\admin\AdminsController;

Route::get('/admin/dashboard', [AdminsController::class, 'index'])->name('admin.home');
Route::get('/admin/login', [AdminsController::class, 'login'])->name('admin.login');
