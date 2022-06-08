<?php

namespace App\Http\Controllers\admin;

use App\Services\admin\ReserveService;
use App\Models\Reservation;

class ReserveController extends Controller
{

  public function index(ReserveService $reserveService, Reservation $reservation)
  {
    $calendar = $reserveService->createCalendar($reservation);

    $yearMonth = $reserveService->yearMonth();
    $today = $reserveService->dayOfToday();

    $month = $reserveService->lastThisNextMonth();

    return view('admin.reserve', [
      'calendar' => $calendar,
      'yearMonth' => $yearMonth,
      'today' => $today,
      'month' => $month,
    ]);
  }
}
