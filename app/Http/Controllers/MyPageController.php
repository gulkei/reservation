<?php

namespace App\Http\Controllers;

class MyPageController extends Controller
{
  public function index()
  {
    return view('mypage');
  }

  public function display()
  {
    $route = route('mypage.login.authenticate');
    return view('login', [
      'route' => $route,
    ]);
  }
}
