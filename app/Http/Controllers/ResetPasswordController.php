<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\ResetRequest;
use App\Services\ResetPasswordService;

use Illuminate\Http\Request;

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
   * @param  \App\Services\ResetPasswordService $resetPasswordService
   * @return \Illuminate\Http\Response
   */
  public function update(ResetRequest $request, ResetPasswordService $resetPasswordService)
  {
    return $resetPasswordService->updatePassword($request);
  }
}
