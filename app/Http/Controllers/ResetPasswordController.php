<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

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
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request)
  {
    $request->validate([
      'token' => 'required',
      'email' => 'required|email',
      'password' => 'required|min:8|max:255|confirmed',
    ]);

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
