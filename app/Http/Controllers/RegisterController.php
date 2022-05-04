<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

class RegisterController extends Controller
{
  public function index()
  {
    return view('register');
  }

  /**
   * ユーザ新規登録
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function create(Request $request)
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
    return view('confirm');
  }
}
