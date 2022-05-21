<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Http\Requests\User\ResetRequest;

class ResetPasswordController extends Controller
{

  /**
   * @param  \Illuminate\Http\Request  $request
   */
  public function index(Request $request, $token)
  {
    $email = $request->get('email');
    return view('reset-password', [
      'token' => $token,
      'email' => $email,
    ]);
  }

  /**
   * パスワード再設定更新
   *
   * @param  \App\Http\Requests\User\ResetRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function update(ResetRequest $request)
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
