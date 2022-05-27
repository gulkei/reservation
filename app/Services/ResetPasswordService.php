<?php

namespace App\Services;

use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class ResetPasswordService
{
  /**
   * パスワード再設定
   * @param  \App\Http\Requests\User\ResetRequest  $request
   */
  public function updatePassword($request)
  {
    $status = Password::reset(
      $request->only('email', 'password', 'password_confirmation', 'token'),
      function ($user, $password) {
        $user->forceFill([
          'password' => Hash::make($password)
        ])->setRememberToken(Str::random(60));

        $user->save();

        event(new PasswordReset($user));
      }
    );

    return $status === Password::PASSWORD_RESET
      ? redirect()->route('mypage.login')->with('status', __($status))
      : back()->withErrors(['email' => [__($status)]]);
  }
}
