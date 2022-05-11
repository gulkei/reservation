<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\LoginRequest;

class LoginController extends Controller
{

  /**
   * 認証の試行を処理
   *
   * @param  \App\Http\Requests\User\LoginRequest  $request
   * @return \Illuminate\Http\Response
   */

  public function authenticate(LoginRequest $request)
  {

    // 認証処理
    $credentials = $request->validated();

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      // マイページログインからの場合はマイページへ遷移させる
      $requestUrl = $request->url();
      $route = route('mypage.login');
      if ($requestUrl === $route) {
        return redirect()->intended('mypage');
      }

      return redirect()->intended('reservation/confirm');
    }

    return back()->withErrors([
      'all' => 'メールアドレスまたはパスワードが違っています。',
    ])->onlyInput('email');
  }
}
