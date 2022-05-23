<?php

namespace App\Http\Controllers\admin;

class AdminsController extends Controller
{

  public function index()
  {
    return view('admin.index');
  }

  public function login()
  {
    return view('admin.login');
  }
}
