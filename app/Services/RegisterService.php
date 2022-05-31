<?php

namespace App\Services;

use App\Models\User;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterService
{
  /**
   * @return string
   */
  public function getKeyword()
  {
    // Headerの新規登録ボタンからの場合と、
    // 予約からの新規登録の場合
    $prevUrl = url()->previous();
    $hasReservation = Str::contains($prevUrl, 'reservation');
    $hasRegister = Str::contains($prevUrl, 'register');

    if ($hasReservation || $hasRegister) {
      $keyword = 'reservation';
    } else {
      $keyword = 'new';
    }

    return $keyword;
  }

  /**
   * @param \Illuminate\Http\Request $request
   */
  public function createUser($request)
  {
    $credentials = $request->validated();
    // ユーザ登録用にパスワードハッシュ化
    $credentials['password'] = Hash::make($credentials['password']);

    try {
      // ユーザ登録
      User::create($credentials);
    } catch (\Exception $e) {
      Log::error($e);
      Log::error('ユーザの新規作成に失敗しました。');

      return redirect()->route('home')->withErrors([
        'all' => '新規作成に失敗しました。もう一度新規作成してください。',
      ]);
    }
  }

  /**
   * @param \Illuminate\Http\Request $request
   * @param string $string
   */
  public function login($request, $keyword)
  {
    // 認証もさせておく
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      if ($keyword === 'new') {
        return redirect()->route('home');
      }

      $reservationInfo = $this->getReservationInfo();

      return view('confirm', [
        'reservationInfo' => $reservationInfo,
      ]);
    }

    return back()->withErrors([
      'all' => 'エラーが発生しました。',
    ])->onlyInput('name', 'email');
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
  public function getReservationInfo()
  {
    $reservationInfo = $this->getSession();
    $reservationInfo->put('user', $this->getUser());

    return $reservationInfo;
  }
}
