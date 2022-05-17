<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\StoreRequest;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{

  /**
   * @param  \Illuminate\Http\Request  $request
   */
  public function index(Request $request)
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

    return view('register', [
      'keyword' => $keyword,
    ]);
  }

  /**
   * ユーザ新規登録
   * @param  \App\Http\Requests\User\StoreRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function create(StoreRequest $request, $keyword)
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

    // 認証もさせておく
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

      if ($keyword === 'new') {
        return redirect()->route('home');
      }

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

    return back()->withErrors([
      'all' => 'エラーが発生しました。',
    ])->onlyInput('name', 'email');
  }
}
