<?php

namespace App\Http\Controllers;

class HomeController extends Controller
{

  public function index()
  {
    // カレンダーの作成
    // 曜日と日付を取得

    return view('home');
  }
}
