<?php

namespace App\Http\Controllers\admin;

class UserController extends Controller
{

  public function index()
  {
    return view('admin.user');
  }
}
