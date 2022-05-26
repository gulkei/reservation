<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\LoginRequest;
use App\Services\MyPageService;

class MyPageController extends Controller
{
  public function index()
  {
    return view('mypage');
  }

  public function display()
  {
    $route = route('mypage.login.authenticate');
    return view('login', [
      'route' => $route,
    ]);
  }

  /**
   * ユーザーをアプリケーションからログアウトさせる
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function logout(MyPageService $myPageService, Request $request)
  {
    return $myPageService->logout($request);
  }

  /**
   * 認証の試行を処理
   *
   * @param  \App\Http\Requests\User\LoginRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function login(MyPageService $myPageService, LoginRequest $request)
  {
    return $myPageService->login($request);
  }
}
