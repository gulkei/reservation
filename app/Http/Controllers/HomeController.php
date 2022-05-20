<?php

namespace App\Http\Controllers;

use App\Services\HomeService;

class HomeController extends Controller
{

  /**
   * @param App\Services\HomeService $homeService
   * @return view
   */
  public function index(HomeService $homeService)
  {
    // カレンダーの作成
    $calendar = $homeService->getCalendar();

    return view('home', [
      'calendar' => $calendar,
    ]);
  }
}
