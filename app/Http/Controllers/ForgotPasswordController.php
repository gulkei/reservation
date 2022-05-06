<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;

class ForgotPasswordController extends Controller
{

  public function index()
  {
    return view('forgot-password');
  }

  /**
   * パスワード再設定リンクを送信
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function send(Request $request)
  {
    $request->validate(['email' => 'required|email']);

    $status = Password::sendResetLink(
      $request->only('email')
    );

    // 登録していないユーザでもリセットメールを送信したメッセージを表示させる(実際には送信していない)。
    $userStatus = $status === Password::INVALID_USER;

    if ($userStatus) {
      $status = 'passwords.sent';
    }

    return $status === Password::RESET_LINK_SENT
      ? back()->with(['status' => __($status)])
      : back()->withErrors(['email' => __($status)]);
  }
}
