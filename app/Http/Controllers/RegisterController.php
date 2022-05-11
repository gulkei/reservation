<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;


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
    if (Str::contains($prevUrl, 'reservation')) {
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
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request, $keyword)
  {

    // validation
    $request->validate([
      'name' => [
        'required',
        'string',
        'max:255',
      ],
      'email' => [
        'required',
        'email:rfc,dns',
        'string',
        'max:255',
        'unique:users',
      ],
      'password' => [
        'required',
        'min:8',
        'max:255',
        'confirmed',
      ],
      'request' => [
        'max:255',
      ],
    ]);

    // ユーザ登録
    User::create([
      'name' => $request->input('name'),
      'email' => $request->input('email'),
      'password' => Hash::make($request->input('password')),
    ]);

    if ($keyword === 'new') {
      return redirect()->route('home');
    }

    // 認証もさせておく
    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
      $request->session()->regenerate();

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
    } else {
      return back()->withErrors([
        'all' => 'エラーが発生しました。',
      ])->onlyInput('name', 'email');
    }
  }
}
