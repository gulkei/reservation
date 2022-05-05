<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MyPageController;
use App\Http\Controllers\LoginController;

Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage.login');
Route::post('/mypage', [LoginController::class, 'authenticate'])->name('mypage.login.authenticate');
