<?php

namespace App\Http\Controllers;

class ReservationController extends Controller
{
  public function index()
  {
    $route = route('reservation.login');
    return view('reservation', [
      'route' => $route,
    ]);
  }

  public function confirm()
  {
    return view('confirm');
  }
}
