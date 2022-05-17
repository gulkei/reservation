<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Models\ReservationRecord;
use App\Http\Requests\User\LoginRequest;
use App\Mail\ReservationCompleted;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReservationController extends Controller
{
  public function index(Request $request)
  {
    // 予約情報(予約項目、日付)をsessionへ一時保存
    // TODO: 動的に(予約項目が増える)対応できるように書き換える
    $year = $request->input('year');
    $time = $request->input('time');
    $date = $request->input('date');
    $menu = $request->input('menu');

    session()->put('year', $year);
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
    $year = session()->get('year');
    $time = session()->get('time');
    $date = session()->get('date');
    $menu = session()->get('menu');

    $user = Auth::user();

    return view('confirm', [
      'year' => $year,
      'time' => $time,
      'date' => $date,
      'menu' => $menu,
      'user' => $user,
    ]);
  }

  public function store(Request $request)
  {
    $request->validate([
      'request' => 'max:1000',
    ]);

    $year = session()->get('year');
    $time = session()->get('time');
    $date = session()->get('date');
    $menu = session()->get('menu');

    $user = Auth::user();

    DB::beginTransaction();

    try {

      $reservation = Reservation::create([
        'users_id' => $user['id'],
        'name' => $user['name'],
        'email' => $user['email'],
        'reservation_year' => $year,
        'reservation_date' => $date,
        'reservation_time' => $time,
        'request' => $request['request'],
      ]);

      ReservationRecord::create([
        'reservations_id' => $reservation['id'],
        'item' => $menu,
      ]);

      DB::commit();
    } catch (\Exception $e) {
      // 作成失敗時
      Log::error($e);
      Log::error('予約の登録に失敗しました。');
      DB::rollBack();

      return redirect()->route('home')->withErrors([
        'all' => '予約に失敗しました。もう一度予約してください。',
      ]);
    }

    Mail::to($user['email'])->send(new ReservationCompleted($reservation));

    return redirect()->intended('reservation/complete')->with([
      'reservationId' => $reservation['id'],
    ]);
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
