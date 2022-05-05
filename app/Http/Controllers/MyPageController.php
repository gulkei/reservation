<?php

namespace App\Http\Controllers;

class MyPageController extends Controller
{
  public function index()
  {
    $route = route('mypage.login.authenticate');
    return view('login', [
      'route' => $route,
    ]);
  }
}
