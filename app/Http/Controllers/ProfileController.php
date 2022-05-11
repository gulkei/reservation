<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\UpdateRequest;
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
   * @param  \App\Http\Requests\User\UpdateRequest  $request
   * @param  \App\Models\User  $user
   * @return \Illuminate\Http\Response
   */
  public function update(UpdateRequest $request, User $user)
  {

    // NOTE: passwordは任意のため、nullの場合とそうでない場合がある。
    // nullableでnull許容しているが、
    // null,空文字の場合は値をセットしたくないため、
    // emptyで判定している。
    if (!empty($request['password'])) {
      $user->password = Hash::make($request['password']);
    }

    $user->name = $request['name'];
    $user->email = $request['email'];

    $user->save();

    return redirect()->intended('mypage');
  }
}
