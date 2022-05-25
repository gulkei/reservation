<?php

namespace App\Services;

use Illuminate\Support\Facades\Password;

class ForgotPasswordService
{
  /**
   * パスワード再設定リンクを送信
   */
  public function sendResetMail($request)
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
