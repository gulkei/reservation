<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\User\ForgotRequest;
use App\Services\ForgotPasswordService;

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
   * @param  \App\Services\ForgotPasswordService  $forgotPasswordService
   * @return \Illuminate\Http\Response
   */
  public function send(ForgotRequest $request, ForgotPasswordService $forgotPasswordService)
  {
    return $forgotPasswordService->sendResetMail($request);
  }
}
