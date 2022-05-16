<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

class WithdrawalController extends Controller
{

  public function index()
  {
    return view('withdrawal');
  }

  public function delete()
  {

    $user = Auth::user();

    $user->delete();

    return redirect()->route('home');
  }
}
