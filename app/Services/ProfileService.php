<?php

namespace App\Services;

use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ProfileService
{
  /**
   * ユーザ情報更新
   * @param  \App\Http\Requests\User\UpdateRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function update($request)
  {
    $user = $this->setUser($request);

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

  /**
   * @param \App\Http\Requests\User\UpdateRequest  $request
   * @return \App\Models\User
   */
  public function setUser($request)
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

    return $user;
  }
}
