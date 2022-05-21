<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use App\Http\Requests\User\ForgotRequest;

class ForgotPasswordController extends Controller
{

  public function index()
  {
    return view('forgot-password');
  }

  /**
   * パスワード再設定リンクを送信
   *
   * @param  \App\Http\Requests\User\ForgotRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function send(ForgotRequest $request)
  {

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
