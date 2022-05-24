<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

  public function index()
  {
    return view('admin.login');
  }

  public function login(Request $request)
  {

    $credentials = $request->validate([
      'email' => [
        'required',
        'email'
      ],
      'password' => ['required'],
    ]);

    $guard = 'admin';

    if (Auth::guard($guard)->attempt($credentials)) {
      $request->session()->regenerate();

      return redirect()->intended('admin/dashboard');
    }

    return back()->withErrors([
      'all' => 'メールアドレスまたはパスワードが違っています。',
    ])->onlyInput('email');
  }
}
