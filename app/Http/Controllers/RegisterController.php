<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Http\Requests\User\StoreRequest;
use App\Services\RegisterService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class RegisterController extends Controller
{

  /**
   * @param  \App\Services\RegisterService $registerService
   */
  public function index(RegisterService $registerService)
  {
    $keyword = $registerService->getKeyword();

    return view('register', [
      'keyword' => $keyword,
    ]);
  }

  /**
   * ユーザ新規登録
   * @param  \App\Http\Requests\User\StoreRequest  $request
   * @param  \App\Services\RegisterService $registerService
   * @return \Illuminate\Http\Response
   */
  public function create(StoreRequest $request, RegisterService $registerService, $keyword)
  {

    $registerService->createUser($request);

    return $registerService->login($request, $keyword);
  }
}
