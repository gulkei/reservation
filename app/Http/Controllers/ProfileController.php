<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\UpdateRequest;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{

  public function index()
  {

    $user = Auth::user();

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
  public function update(UpdateRequest $request)
  {
    $user = Auth::user();

    $user->name = $request['name'];
    $user->email = $request['email'];

    // NOTE: passwordは任意のため、nullの場合とそうでない場合がある。
    // nullableでnull許容しているが、
    // null,空文字の場合は値をセットしたくないため、
    // emptyで判定している。
    if (!empty($request['password'])) {
      $user->password = Hash::make($request['password']);
    }

    try {
      $user->save();
    } catch (\Exception $e) {
      Log::error($e);
      Log::error('プロフィールの更新に失敗しました。');

      return back()->withErrors([
        'all' => 'エラーが発生しました。もう一度やり直してください',
      ])->onlyInput('name', 'email');
    }

    return redirect()->intended('mypage');
  }
}
