<?php

namespace App\Http\Controllers;

class ReservationController extends Controller
{
  public function index()
  {
    return view('reservation');
  }

  public function confirm()
  {
    return view('confirm');
  }
}
