<?php

namespace App\Http\Controllers\admin;

use App\Models\User;

class UserController extends Controller
{

  public function index(User $user)
  {
    // user取得
    $paginator = $user->getUserPaginate();

    return view('admin.user', [
      'paginator' => $paginator,
    ]);
  }
}
