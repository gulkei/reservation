<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{

  /**
   * @param  \App\Models\User  $user
   */
  public function index(User $user)
  {
    return view('profile', [
      'user' => $user,
    ]);
  }

  /**
   * ユーザ情報更新
   * @param  \Illuminate\Http\Request  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(Request $request, User $user)
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
      ],
    ]);

    if (!empty($request['password'])) {
      $request->validate([
        'password' => [
          'min:8',
          'max:255',
          'confirmed',
        ],
      ]);
      $user->password = Hash::make($request['password']);
    }

    $user->name = $request['name'];
    $user->email = $request['email'];

    $user->save();

    return redirect()->intended('mypage');
  }
}
