<?php

namespace App\Http\Controllers;

use App\Http\Requests\User\LoginRequest;
use App\Http\Requests\ReservationRequest;
use App\Services\ReservationService;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReservationController extends Controller
{
  public function index(Request $request, ReservationService $reservationService)
  {
    $reservationService->setSession($request);

    if (Auth::check()) {
      return redirect()->intended('reservation/confirm');
    }

    $route = route('reservation.login');
    return view('reservation', [
      'route' => $route,
    ]);
  }

  public function confirm(ReservationService $reservationService)
  {
    $reservationInfo = $reservationService->getReservationInfo();

    return view('confirm', [
      'reservationInfo' => $reservationInfo,
    ]);
  }

  public function store(ReservationRequest $request, ReservationService $reservationService)
  {

    if (!empty($request->input('name')) && !empty($request->input('email'))) {
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
      ]);
    }

    return $reservationService->store($request);
  }

  public function complete()
  {
    return view('complete');
  }

  /**
   * 認証の試行を処理
   *
   * @param  \App\Http\Requests\User\LoginRequest  $request
   * @return \Illuminate\Http\Response
   */
  public function login(LoginRequest $request, ReservationService $reservationService)
  {
    return $reservationService->login($request);
  }
}
