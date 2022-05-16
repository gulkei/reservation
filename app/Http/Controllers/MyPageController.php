<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\LoginRequest;

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

  /**
   * 認証の試行を処理
   *
   * @param  \App\Http\Requests\User\LoginRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function login(LoginRequest $request)
  {
    // HACK: ReservationControllerのloginとほぼかぶっている。
    // 認証処理
    $credentials = $request->validated();

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      return redirect()->intended('mypage');
    }

    return back()->withErrors([
      'all' => 'メールアドレスまたはパスワードが違っています。',
    ])->onlyInput('email');
  }
}
