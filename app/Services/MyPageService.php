<?php

namespace App\Services;

use Illuminate\Support\Facades\Auth;

class MyPageService
{

  /**
   * ユーザーをアプリケーションからログアウトさせる
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function logout($request)
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
  public function login($request)
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
