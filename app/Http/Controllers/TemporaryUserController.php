<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests\TemporaryRequest;

class TemporaryUserController extends Controller
{
  public function index()
  {
    return view('no-register');
  }

  public function confirm(TemporaryRequest $request)
  {

    $reservationInfo = session()->get('reservationInfo');

    $user = collect([
      'name' => $request->input('name'),
      'email' => $request->input('email'),
    ]);

    $reservationInfo->put('user', $user);

    // ユーザー登録した場合とそうでない場合に画面を出し分けする用
    session()->put('route', 'tmp');

    return view('confirm', [
      'reservationInfo' => $reservationInfo,
    ]);
  }
}
