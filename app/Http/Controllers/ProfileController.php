<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\UpdateRequest;
use App\Services\ProfileService;
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
   * @return \Illuminate\Http\Response
   */
  public function update(ProfileService $profileService, UpdateRequest $request)
  {
    return $profileService->update($request);
  }
}
