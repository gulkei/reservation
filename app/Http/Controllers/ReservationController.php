<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests\User\LoginRequest;

class ReservationController extends Controller
{
  public function index(Request $request)
  {
    // 予約情報(予約項目、日付)をsessionへ一時保存
    // TODO: 動的に(予約項目が増える)対応できるように書き換える
    $time = $request->input('time');
    $date = $request->input('date');
    $menu = $request->input('menu');

    session()->put('time', $time);
    session()->put('date', $date);
    session()->put('menu', $menu);

    if (Auth::check()) {
      return redirect()->intended('reservation/confirm');
    }

    $route = route('reservation.login');
    return view('reservation', [
      'route' => $route,
    ]);
  }

  public function confirm()
  {
    // TODO: 動的に(予約項目が増える)対応できるように書き換える
    $time = session()->get('time');
    $date = session()->get('date');
    $menu = session()->get('menu');

    $user = Auth::user();

    return view('confirm', [
      'time' => $time,
      'date' => $date,
      'menu' => $menu,
      'user' => $user,
    ]);
  }

  public function update(Request $request)
  {
    // TODO: validationして保存処理
    return redirect()->intended('reservation/complete');
  }

  public function complete()
  {
    return view('complete');
  }

  /**
   * 認証の試行を処理
   *
   * @param  \App\Http\Requests\User\LoginRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function login(LoginRequest $request)
  {
    // HACK: MyPageControllerのloginとほぼかぶっている。
    // 認証処理
    $credentials = $request->validated();

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      return redirect()->intended('reservation/confirm');
    }

    return back()->withErrors([
      'all' => 'メールアドレスまたはパスワードが違っています。',
    ])->onlyInput('email');
  }
}
