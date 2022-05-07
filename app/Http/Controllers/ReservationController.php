<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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
}
