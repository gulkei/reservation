<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

  /**
   * 認証の試行を処理
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */

  public function authenticate(Request $request)
  {

    // 認証処理
    $credentials = $request->validate([
      'email' => ['required', 'email'],
      'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      return redirect()->intended('reservation/confirm');
    }

    return back()->withErrors([
      'all' => 'メールアドレスまたはパスワードが違っています。',
    ])->onlyInput('email');
  }
}
