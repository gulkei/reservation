<?php

namespace App\Http\Controllers;

use App\Models\User;

class HistoryController extends Controller
{

  /**
   * @param  \App\Models\User  $user
   */
  public function index(User $user)
  {
    return view('history', [
      'user' => $user,
    ]);
  }
}
