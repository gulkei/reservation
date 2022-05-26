<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use App\Services\HistoryService;
use Illuminate\Support\Facades\Auth;

class HistoryController extends Controller
{

  public function index(HistoryService $historyService, Reservation $reservation)
  {

    // 予約取得
    $paginator = $historyService->getReservationPaginate($reservation);

    return view('history', [
      'paginator' => $paginator,
    ]);
  }
}
