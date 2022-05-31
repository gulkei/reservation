<?php

namespace App\Services;

use App\Models\Reservation;
use App\Models\ReservationRecord;
use App\Mail\ReservationCompleted;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class ReservationService
{

  /**
   * @param \Illuminate\Http\Request $request
   * @param string $string
   */
  public function setSession($request)
  {
    // 予約情報(予約項目、日付)をsessionへ一時保存
    // TODO: 動的に(予約項目が増える)対応できるように書き換える
    $year = $request->input('year');
    $time = $request->input('time');
    $date = $request->input('date');
    $menu = $request->input('menu');

    $reservationInfo = collect([
      'year' => $year,
      'time' => $time,
      'date' => $date,
      'menu' => $menu,
    ]);

    session()->put('reservationInfo', $reservationInfo);
  }

  public function getSession()
  {
    return session()->get('reservationInfo');
  }

  /**
   * @return \App\Models\User
   */
  public function getUser()
  {
    return Auth::user();
  }

  /**
   * @return \Illuminate\Support\Collection
   */
  public function getReservationInfo($request)
  {
    $reservationInfo = $this->getSession();

    if (!empty($request->input('name')) && !empty($request->input('email'))) {
      $user = collect([
        'name' => $request->input('name'),
        'email' => $request->input('email'),
      ]);

      $reservationInfo->put('user', $user);
    } else {
      $reservationInfo->put('user', $this->getUser());
    }

    return $reservationInfo;
  }

  /**
   * 会員登録しないで予約に対応するため
   * それぞれでデータの中身が違う
   */
  public function setReservation($request, $reservationInfo)
  {
    if (!empty($request->input('name')) && !empty($request->input('email'))) {

      $reservation = [
        'users_id' => NULL,
        'name' => $reservationInfo['user']['name'],
        'email' => $reservationInfo['user']['email'],
        'reservation_year' => $reservationInfo['year'],
        'reservation_date' => $reservationInfo['date'],
        'reservation_time' => $reservationInfo['time'],
        'request' => $request['request'],
      ];
    } else {

      $reservation = [
        'users_id' => $reservationInfo['user']->id,
        'name' => $reservationInfo['user']->name,
        'email' => $reservationInfo['user']->email,
        'reservation_year' => $reservationInfo['year'],
        'reservation_date' => $reservationInfo['date'],
        'reservation_time' => $reservationInfo['time'],
        'request' => $request['request'],
      ];
    }

    return $reservation;
  }

  public function sendMail($request, $reservation, $reservationInfo)
  {
    if (!empty($request->input('name')) && !empty($request->input('email'))) {
      Mail::to($reservationInfo['user']['email'])->send(new ReservationCompleted($reservation));
    } else {
      Mail::to($reservationInfo['user']->email)->send(new ReservationCompleted($reservation));
    }
    return;
  }

  /**
   * 予約情報保存
   * @return \Illuminate\Http\Response
   */
  public function store($request)
  {
    $reservationInfo = $this->getReservationInfo($request);

    $reservation = $this->setReservation($request, $reservationInfo);

    DB::beginTransaction();

    try {

      $reservation = Reservation::create($reservation);

      ReservationRecord::create([
        'reservations_id' => $reservation['id'],
        'item' => $reservationInfo['menu'],
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

    $this->sendMail($request, $reservation, $reservationInfo);

    return redirect()->intended('reservation/complete')->with([
      'reservationId' => $reservation['id'],
    ]);
  }

  /**
   * 認証の試行を処理
   *
   * @param  \App\Http\Requests\User\LoginRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function login($request)
  {
    // HACK: ReservationControllerのloginとほぼかぶっている。
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
