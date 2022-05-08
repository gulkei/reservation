<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MyPageController;
use App\Http\Controllers\LoginController;

Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
Route::get('/mypage/login', [MyPageController::class, 'display'])->name('mypage.login');
Route::post('/mypage/login', [LoginController::class, 'authenticate'])->name('mypage.login.authenticate');


Route::get('/mypage/logout', [MyPageController::class, 'logout'])->name('mypage.logout');
