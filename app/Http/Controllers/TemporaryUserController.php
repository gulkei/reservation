<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TemporaryUserController extends Controller
{
  public function index()
  {
    return view('no-register');
  }

  public function confirm(Request $request)
  {
    // validation
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
      'request' => [
        'max:255',
      ],
    ]);

    $time = session()->get('time');
    $date = session()->get('date');
    $menu = session()->get('menu');

    $user = [
      'name' => $request->input('name'),
      'email' => $request->input('email'),
    ];

    return view('confirm', [
      'time' => $time,
      'date' => $date,
      'menu' => $menu,
      'user' => $user,
    ]);
  }
}
