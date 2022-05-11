<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\MyPageController;

Route::get('/mypage/login', [MyPageController::class, 'display'])->name('mypage.login');
Route::post('/mypage/login', [MyPageController::class, 'login'])->name('mypage.login.authenticate');

Route::middleware('auth')->group(function () {
  Route::get('/mypage', [MyPageController::class, 'index'])->name('mypage');
  Route::get('/mypage/logout', [MyPageController::class, 'logout'])->name('mypage.logout');
});
