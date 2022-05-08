<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

  /**
   * ユーザーをアプリケーションからログアウトさせる
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function logout(Request $request)
  {
    Auth::logout();

    $request->session()->invalidate();

    $request->session()->regenerateToken();

    return redirect('/');
  }
}
