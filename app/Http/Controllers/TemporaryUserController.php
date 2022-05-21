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

    $year = session()->get('year');
    $time = session()->get('time');
    $date = session()->get('date');
    $menu = session()->get('menu');

    $user = [
      'name' => $request->input('name'),
      'email' => $request->input('email'),
    ];

    return view('confirm', [
      'year' => $year,
      'time' => $time,
      'date' => $date,
      'menu' => $menu,
      'user' => $user,
    ]);
  }
}
