<?php

namespace App\Http\Controllers\admin;

use App\Services\admin\ReserveService;

class ReserveController extends Controller
{

  public function index(ReserveService $reserveService)
  {
    $calendar = $reserveService->createCalendar();

    $yearMonth = $reserveService->getYearMonth();
    $today = $reserveService->getDayOfToday();

    // 予約取得

    return view('admin.reserve', [
      'calendar' => $calendar,
      'yearMonth' => $yearMonth,
      'today' => $today,
    ]);
  }
}
