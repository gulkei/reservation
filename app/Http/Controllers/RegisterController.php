<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

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

    // 確認画面へリダイレクト
    // TODO: お問い合わせ内容を次画面へ渡す

    if ($keyword === 'new') {
      return redirect()->route('home');
    }

    return view('confirm');
  }
}
